<?php
include '../config.php';

// Check if student is logged in
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reason = trim($_POST['reason']);
    if(!empty($reason)){
        $stmt = $conn->prepare("INSERT INTO outpass (user_id, reason) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $reason);
        $stmt->execute();
    }
    // Redirect back to student dashboard
    header("Location: ../students/dashboard.php");
    exit;
}
?>
