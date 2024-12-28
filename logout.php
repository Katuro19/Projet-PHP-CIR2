<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    session_unset();
    session_destroy();
    setcookie('user_email', '', time() - 3600, "/"); // Expire the cookie
    header("Location: login.php");
    exit();
}
?>