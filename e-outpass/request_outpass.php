<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reason = $_POST['reason'];
    $stmt = $conn->prepare("INSERT INTO outpass (user_id, reason) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $reason);
    $stmt->execute();
    echo "<p style='color:green;'>Outpass request submitted!</p>";
}
?>

<h2>Request Outpass</h2>
<form method="POST">
    <textarea name="reason" rows="5" cols="50" required></textarea><br><br>
    <button type="submit">Request</button>
</form>

<?php include '../includes/footer.php'; ?>
