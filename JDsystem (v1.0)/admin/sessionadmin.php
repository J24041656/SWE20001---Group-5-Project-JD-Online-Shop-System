<?php
session_start();

// Check if user is not logged in, redirect to loginadmin.php
if (!isset($_SESSION['loggedIn'])) {
    header('Location: loginadmin.php');
    exit;
}

// Other session management functions can be added here