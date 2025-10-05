<?php
include '../config.php';
include '../includes/header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_GET['booking_id'])){
    $booking_id = intval($_GET['booking_id']);
    
    // Get the room_id
    $booking = $conn->query("SELECT room_id FROM bookings WHERE id=$booking_id")->fetch_assoc();
    if($booking){
        $room_id = $booking['room_id'];
        // Delete booking
        $conn->query("DELETE FROM bookings WHERE id=$booking_id");
        // Increase availability
        $conn->query("UPDATE rooms SET available = available + 1 WHERE id=$room_id");
    }
    header("Location: ../students/dashboard.php"); // redirect back
    exit;
}
?>
