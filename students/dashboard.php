<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';
?>

<h2>Student Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
<ul>
    <li><a href="../bookings/book_room.php">Book a Room</a></li>
    <li><a href="../complaints/submit_complaint.php">Submit Complaint</a></li>
    <li><a href="../e-outpass/request_outpass.php">Request Outpass</a></li>
</ul>

<?php include '../includes/footer.php'; ?>
