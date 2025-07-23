<?php

require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
  $stmt->execute([
    $_POST['username'],
    password_hash($_POST['password'], PASSWORD_DEFAULT)
  ]);
  echo "Admin created.";
} else {
  echo '<form method="post">
    <input type="text" name="username" placeholder="Admin username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Create Admin</button>
  </form>';
}