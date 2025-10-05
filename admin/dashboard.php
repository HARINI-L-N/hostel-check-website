<?php
include '../config.php';
include '../includes/header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../login.php");
    exit;
}

// Handle complaint resolution
if(isset($_GET['resolve_complaint'])){
    $complaint_id = intval($_GET['resolve_complaint']);
    $conn->query("UPDATE complaints SET status='resolved' WHERE id=$complaint_id");
    header("Location: dashboard.php");
    exit;
}

// Handle outpass approval/rejection
if(isset($_GET['approve_outpass'])){
    $outpass_id = intval($_GET['approve_outpass']);
    $conn->query("UPDATE outpass SET status='approved' WHERE id=$outpass_id");
    header("Location: dashboard.php");
    exit;
}
if(isset($_GET['reject_outpass'])){
    $outpass_id = intval($_GET['reject_outpass']);
    $conn->query("UPDATE outpass SET status='rejected' WHERE id=$outpass_id");
    header("Location: dashboard.php");
    exit;
}

// Fetch summary data
$students = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='student'")->fetch_assoc()['total'];
$rooms = $conn->query("SELECT COUNT(*) as total FROM rooms")->fetch_assoc()['total'];
$bookings = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];
$pending_complaints = $conn->query("SELECT COUNT(*) as total FROM complaints WHERE status='open'")->fetch_assoc()['total'];
$pending_outpass = $conn->query("SELECT COUNT(*) as total FROM outpass WHERE status='pending'")->fetch_assoc()['total'];
?>

<h2>Admin Dashboard</h2>

<div style="display:flex; justify-content:space-around; margin:20px 0;">
    <div style="background:#004aad; color:#fff; padding:15px; border-radius:8px; width:150px; text-align:center;">
        <h3><?php echo $students; ?></h3>
        <p>Students</p>
    </div>
    <div style="background:#004aad; color:#fff; padding:15px; border-radius:8px; width:150px; text-align:center;">
        <h3><?php echo $rooms; ?></h3>
        <p>Rooms</p>
    </div>
    <div style="background:#004aad; color:#fff; padding:15px; border-radius:8px; width:150px; text-align:center;">
        <h3><?php echo $bookings; ?></h3>
        <p>Bookings</p>
    </div>
    <div style="background:#004aad; color:#fff; padding:15px; border-radius:8px; width:150px; text-align:center;">
        <h3><?php echo $pending_complaints; ?></h3>
        <p>Pending Complaints</p>
    </div>
    <div style="background:#004aad; color:#fff; padding:15px; border-radius:8px; width:150px; text-align:center;">
        <h3><?php echo $pending_outpass; ?></h3>
        <p>Pending Outpass</p>
    </div>
</div>

<h3>Pending Complaints</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Complaint</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    $sql = "SELECT c.id, u.name as student, c.complaint_text, c.status
            FROM complaints c
            JOIN users u ON c.user_id = u.id
            WHERE c.status='open'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['student']}</td>
                <td>{$row['complaint_text']}</td>
                <td>{$row['status']}</td>
                <td><a href='dashboard.php?resolve_complaint={$row['id']}'>Resolve</a></td>
              </tr>";
    }
    ?>
</table>

<h3>Pending Outpass Requests</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Student</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    $sql = "SELECT o.id, u.name as student, o.reason, o.status
            FROM outpass o
            JOIN users u ON o.user_id = u.id
            WHERE o.status='pending'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['student']}</td>
                <td>{$row['reason']}</td>
                <td>{$row['status']}</td>
                <td>
                    <a href='dashboard.php?approve_outpass={$row['id']}'>Approve</a> | 
                    <a href='dashboard.php?reject_outpass={$row['id']}'>Reject</a>
                </td>
              </tr>";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>
