<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$action = $_GET['action']; // approved or rejected

$conn->query("UPDATE outpass SET status='$action' WHERE id=$id");
header("Location: manage_outpass.php");
exit;
?>
