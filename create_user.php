<?php
require 'db.php';
require 'auth.php';
if (!isAdmin()) die("Forbidden");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
  $stmt->execute([
    $_POST['username'],
    password_hash($_POST['password'], PASSWORD_DEFAULT)
  ]);
  echo "User created.";
} else {
  echo '<form method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Create User</button>
  </form>';
}