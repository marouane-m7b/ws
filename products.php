<?php
require 'db.php';
require 'auth.php';
if (!isLogged()) die("Unauthorized");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $pdo->prepare("INSERT INTO products (name, price, user_id) VALUES (?, ?, ?)");
  $stmt->execute([
    $_POST['name'],
    $_POST['price'],
    $_SESSION['user']['id']
  ]);
}

// Fetch products
$stmt = $pdo->prepare("SELECT * FROM products WHERE user_id = ?");
$stmt->execute([$_SESSION['user']['id']]);
$products = $stmt->fetchAll();
?>

<!-- HTML STARTS HERE -->
<form method="post">
  <input type="text" name="name" placeholder="Product Name" required>
  <input type="number" step="0.01" name="price" placeholder="Price" required>
  <button type="submit">Add Product</button>
</form>
<br>

<?php foreach ($products as $p): ?>
  <?= htmlspecialchars($p['name']) ?> - <?= htmlspecialchars($p['price']) ?>
  <a href="edit_product.php?id=<?= $p['id'] ?>">Edit</a>
  <a href="delete_product.php?id=<?= $p['id'] ?>">Delete</a>
  <br>
<?php endforeach; ?>
