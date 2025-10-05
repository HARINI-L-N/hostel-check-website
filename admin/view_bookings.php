<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';

$bookings = $conn->query("
    SELECT b.id, u.name, r.room_no, b.booking_date
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN rooms r ON b.room_id = r.id
");
?>

<h2>All Bookings</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Room</th>
        <th>Date</th>
    </tr>
    <?php while($b = $bookings->fetch_assoc()): ?>
    <tr>
        <td><?php echo $b['id']; ?></td>
        <td><?php echo $b['name']; ?></td>
        <td><?php echo $b['room_no']; ?></td>
        <td><?php echo $b['booking_date']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>
