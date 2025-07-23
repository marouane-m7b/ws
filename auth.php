<?php
session_start();
function isLogged() {
  return isset($_SESSION['user']);
}

function isAdmin() {
    return isLogged() && $_SESSION['user']['role'] === 'admin';
}