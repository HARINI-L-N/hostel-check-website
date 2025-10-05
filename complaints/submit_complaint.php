<?php
include '../config.php';

// Check if student is logged in
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = trim($_POST['complaint_text']);
    if(!empty($text)){
        $stmt = $conn->prepare("INSERT INTO complaints (user_id, complaint_text) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $text);
        $stmt->execute();
    }
    // Redirect back to student dashboard
    header("Location: ../students/dashboard.php");
    exit;
}
?>
