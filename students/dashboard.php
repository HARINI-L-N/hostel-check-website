<?php
include '../config.php';
include '../includes/header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'student'){
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch student info
$booking = $conn->query("SELECT r.room_no, b.booking_date FROM bookings b JOIN rooms r ON b.room_id=r.id WHERE b.user_id=$user_id")->fetch_assoc();
$complaints = $conn->query("SELECT * FROM complaints WHERE user_id=$user_id");
$outpasses = $conn->query("SELECT * FROM outpass WHERE user_id=$user_id");
?>

<h2>Student Dashboard</h2>

<h3>My Booking</h3>
<?php if($booking): ?>
<p>Room No: <?php echo $booking['room_no']; ?> | Booked On: <?php echo $booking['booking_date']; ?></p>
<?php else: ?>
<p>You have no bookings yet.</p>
<?php endif; ?>

<h3>My Complaints</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Complaint</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    <?php while($row = $complaints->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['complaint_text']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>My Outpass Requests</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    <?php while($row = $outpasses->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['reason']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['request_date']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>Submit Complaint</h3>
<form method="POST" action="../complaints/submit_complaint.php">
    <textarea name="complaint_text" placeholder="Enter your complaint" required></textarea><br>
    <button type="submit">Submit</button>
</form>

<h3>Request E-Outpass</h3>
<form method="POST" action="../e-outpass/request_outpass.php">
    <textarea name="reason" placeholder="Enter reason for outpass" required></textarea><br>
    <button type="submit">Request Outpass</button>
</form>

<?php include '../includes/footer.php'; ?>
