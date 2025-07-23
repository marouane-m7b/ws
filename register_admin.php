<?php

require 'db.php';

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}

function validatePassword($password) {
    return strlen($password) >= 6;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $errors = [];

    if (!validateEmail($email)) {
        $errors[] = "Invalid email format.";
    }

    if (!validateUsername($username)) {
        $errors[] = "Username must be 3-20 characters long and contain only letters, numbers, or underscores.";
    }

    if (!validatePassword($password)) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, 'admin')");
            $stmt->execute([
                $email,
                $username,
                password_hash($password, PASSWORD_DEFAULT)
            ]);
            echo "Admin created successfully.";
        } catch (PDOException $e) {
            echo "Error creating admin: " . htmlspecialchars($e->getMessage());
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
} else {
    echo '<form method="post">
        <input type="email" name="email" placeholder="Admin email" required><br>
        <input type="text" name="username" placeholder="Admin username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Create Admin</button>
    </form>';
}
