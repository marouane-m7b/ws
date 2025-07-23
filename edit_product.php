<?php
require 'db.php';
require 'auth.php';
if (!isLogged()) die("Unauthorized");
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user']['id']]);
$product = $stmt->fetch();
if (!$product) die("Not found or access denied");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ? WHERE id = ? AND user_id = ?");
  $stmt->execute([
    $_POST['name'], $_POST['price'], $id, $_SESSION['user']['id']
  ]);
  header("Location: products.php");
}
echo '<form method="post">
  <input type="text" name="name" value="' . htmlspecialchars($product['name']) . '" required><br>
  <input type="number" step="0.01" name="price" value="' . htmlspecialchars($product['price']) . '" required><br>
  <button type="submit">Update Product</button>
</form>';