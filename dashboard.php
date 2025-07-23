<?php

require 'auth.php';
if (!isLogged()) die("Access denied");
echo "Welcome, " . $_SESSION['user']['username'] . " | <a href='products.php'>Manage Products</a> | <a href='logout.php'>Logout</a><br>";
if (isAdmin()) echo "<a href='create_user.php'>Create New User</a><br>";
