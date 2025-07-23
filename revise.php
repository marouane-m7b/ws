<?php 
// ✅ Step 8: Sessions & Cookies 🍪
// session_start();
// $_SESSION["user"] = "Marouane";
// echo $_SESSION["user"];

// setcookie("theme", "dark", time() + 3600); // 1 hour
// echo "<br>Cookie theme set to: ".$_COOKIE["theme"];


// ✅ Step 9: File Handling
// file_put_contents("file.txt", "Hello World");

// $content = file_get_contents("file.txt");
// echo "<br>File content: " . $content;

// $exists = file_exists("file.txt");
// echo "<br>File exists: " . $exists;

// unlink("file.txt");


// ✅ Step 10: PHP + MySQL (PDO)
// try {
//     $pdo = new PDO("mysql:host=localhost;dbname=testdb", "root", "");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected!";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

// echo "<br> <br>";

// $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
// $stmt->execute(["abdelaziz", "abdelaziz@example.com"]);

// $stmt = $pdo->query("SELECT * FROM users");
// while ($row = $stmt->fetch()) {
//     echo $row["name"] . "<br>";
// }

// ✅ Step 11: Object-Oriented Programming (OOP)
// class User {
//     public $name;
//     public $email;

//     public function __construct($name, $email) {
//         $this->name = $name;
//         $this->email = $email;
//     }

//     public function save() {
//         global $pdo;
//         $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
//         $stmt->execute([$this->name, $this->email]);
//     }
// }

// $user = new User("abdelaziz", "abdelaziz@example.com");
// $user->save();

// $stmt = $pdo->query("SELECT * FROM users");
// while ($row = $stmt->fetch()) {
//     echo $row["name"] . "<br>";
// }


// ✅ Step 13: Mini Project — CRUD (Create, Read, Update, Delete)


?>