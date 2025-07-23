<?php
require 'db.php';
require 'auth.php';
if (!isLogged()) die("Unauthorized");
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user']['id']]);
header("Location: products.php");