<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$conn->query("UPDATE complaints SET status='resolved' WHERE id=$id");
header("Location: view_complaints.php");
exit;
?>
