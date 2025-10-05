<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';

$complaints = $conn->query("
    SELECT c.id, u.name, c.complaint_text, c.status, c.created_at
    FROM complaints c
    JOIN users u ON c.user_id = u.id
");
?>

<h2>All Complaints</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Complaint</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php while($c = $complaints->fetch_assoc()): ?>
    <tr>
        <td><?php echo $c['id']; ?></td>
        <td><?php echo $c['name']; ?></td>
        <td><?php echo $c['complaint_text']; ?></td>
        <td><?php echo $c['status']; ?></td>
        <td><?php echo $c['created_at']; ?></td>
        <td>
            <?php if($c['status']=='open'): ?>
            <a href="resolve_complaint.php?id=<?php echo $c['id']; ?>">Mark Resolved</a>
            <?php else: ?>
            Resolved
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>
