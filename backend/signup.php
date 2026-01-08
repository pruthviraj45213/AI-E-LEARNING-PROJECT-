<?php
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../signup.html');
  exit;
}

$name = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
  header('Location: ../signup.html?error=' . urlencode('Please provide email and password'));
  exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: ../signup.html?error=' . urlencode('Invalid email'));
  exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
  $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:n, :e, :p)');
  $stmt->execute([':n' => $name, ':e' => $email, ':p' => $hash]);
  header('Location: ../login.html?success=1');
  exit;
} catch (PDOException $e) {
  if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
    header('Location: ../signup.html?error=' . urlencode('Email already registered'));
    exit;
  }
  http_response_code(500);
  header('Location: ../signup.html?error=' . urlencode('Database error'));
  exit;
}
