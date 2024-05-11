<?php
// Database configuration for XAMPP/phpMyAdmin
$dbHost = 'localhost';
$dbUsername = 'root'; // Assuming root user for XAMPP
$dbPassword = ''; // Default password is empty for XAMPP
$dbName = 'your_database_name';

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}