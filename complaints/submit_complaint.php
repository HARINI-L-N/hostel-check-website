<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = $_POST['complaint_text'];
    $stmt = $conn->prepare("INSERT INTO complaints (user_id, complaint_text) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $text);
    $stmt->execute();
    echo "<p style='color:green;'>Complaint submitted!</p>";
}
?>

<h2>Submit Complaint</h2>
<form method="POST">
    <textarea name="complaint_text" rows="5" cols="50" required></textarea><br><br>
    <button type="submit">Submit</button>
</form>

<?php include '../includes/footer.php'; ?>
