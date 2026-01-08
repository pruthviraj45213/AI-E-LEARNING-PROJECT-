<?php
require __DIR__ . '/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../login.html');
  exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
  header('Location: ../login.html?error=' . urlencode('Missing fields'));
  exit;
}

$stmt = $pdo->prepare('SELECT id, password, name FROM users WHERE email = :e');
$stmt->execute([':e' => $email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
  header('Location: ../login.html?error=' . urlencode('Invalid credentials'));
  exit;
}

// successful login
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'] ?? '';
header('Location: ../dashboard.php');
exit;
