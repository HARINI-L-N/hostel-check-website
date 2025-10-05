<?php
include '../config.php';
include '../includes/header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_no = trim($_POST['room_no']);
    $capacity = intval($_POST['capacity']);

    if($room_no != '' && $capacity > 0){
        $stmt = $conn->prepare("INSERT INTO rooms (room_no, capacity, available) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $room_no, $capacity, $capacity); // initially all slots available
        $stmt->execute();
        header("Location: dashboard.php"); // redirect back to admin dashboard
        exit;
    }
}
?>

<h2>Add Room</h2>
<form method="POST">
    <label>Room Number:</label><br>
    <input type="text" name="room_no" required><br><br>
    <label>Capacity:</label><br>
    <input type="number" name="capacity" required><br><br>
    <button type="submit">Add Room</button>
</form>

<?php include '../includes/footer.php'; ?>
