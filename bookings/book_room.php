<?php
include '../config.php';
include '../includes/header.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle booking
if(isset($_POST['room_id'])){
    $room_id = intval($_POST['room_id']);
    // Check availability
    $room = $conn->query("SELECT available FROM rooms WHERE id=$room_id")->fetch_assoc();
    if($room['available'] > 0){
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $room_id);
        $stmt->execute();
        // Reduce room availability
        $conn->query("UPDATE rooms SET available = available - 1 WHERE id=$room_id");
        header("Location: ../students/dashboard.php");
        exit;
    } else {
        echo "<p style='color:red;'>Room not available!</p>";
    }
}

// Fetch available rooms
$rooms = $conn->query("SELECT * FROM rooms WHERE available > 0");
?>

<h2>Book a Room</h2>
<form method="POST">
    <label>Select Room:</label><br>
    <select name="room_id" required>
        <?php while($room = $rooms->fetch_assoc()): ?>
            <option value="<?= $room['id'] ?>">
                <?= $room['room_no'] ?> (Available: <?= $room['available'] ?>)
            </option>
        <?php endwhile; ?>
    </select><br><br>
    <button type="submit">Book Room</button>
</form>

<?php include '../includes/footer.php'; ?>
