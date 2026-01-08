<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.html');
  exit;
}
$name = htmlspecialchars($_SESSION['user_name'] ?? 'User');
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $name; ?></h1>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>