<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';

$outpasses = $conn->query("
    SELECT o.id, u.name, o.reason, o.status, o.request_date
    FROM outpass o
    JOIN users u ON o.user_id = u.id
");
?>

<h2>All Outpass Requests</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php while($o = $outpasses->fetch_assoc()): ?>
    <tr>
        <td><?php echo $o['id']; ?></td>
        <td><?php echo $o['name']; ?></td>
        <td><?php echo $o['reason']; ?></td>
        <td><?php echo $o['status']; ?></td>
        <td><?php echo $o['request_date']; ?></td>
        <td>
            <?php if($o['status']=='pending'): ?>
                <a href="update_outpass.php?id=<?php echo $o['id']; ?>&action=approved">Approve</a> |
                <a href="update_outpass.php?id=<?php echo $o['id']; ?>&action=rejected">Reject</a>
            <?php else: ?>
                <?php echo ucfirst($o['status']); ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>
