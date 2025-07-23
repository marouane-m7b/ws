<?php
session_start();

// Set a dummy user ID for testing
$_SESSION['user_id'] = 1;

// 1. Connect to the DB
require 'db.php';

// 2. Create uploads folder if not exists
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// 3. Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile'])) {
    $userId = $_SESSION['user_id'];
    $file = $_FILES['profile'];

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $ext;
    $targetPath = $uploadDir . $filename;

    // Move file and update DB
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $stmt = $pdo->prepare("UPDATE users SET profile = ? WHERE id = ?");
        $stmt->execute(["uploads/$filename", $userId]);
        $msg = "✅ Profile updated!";
    } else {
        $msg = "❌ Upload failed.";
    }
}

// 4. Fetch profile image for display
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, profile FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile</title>
</head>
<body>
    <h2>👤 Profile Upload</h2>

    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="profile" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <?php if (!empty($user['profile'])): ?>
        <h3>👁️ Preview</h3>
        <img src="<?= htmlspecialchars($user['profile']) ?>" width="150" style="border-radius: 8px;">
        <br><br>
        <a href="<?= htmlspecialchars($user['profile']) ?>" download>📥 Download</a>
    <?php endif; ?>
</body>
</html>