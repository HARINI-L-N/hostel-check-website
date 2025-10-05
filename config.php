<?php
// config.php
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP default
$dbname = "hostel_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
