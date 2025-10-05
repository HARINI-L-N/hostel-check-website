<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';
?>

<h2>Admin Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
<ul>
    <li><a href="manage_students.php">Manage Students</a></li>
    <li><a href="../bookings/">View Bookings</a></li>
    <li><a href="../complaints/">View Complaints</a></li>
    <li><a href="../e-outpass/">Manage Outpasses</a></li>
</ul>

<?php include '../includes/footer.php'; ?>
