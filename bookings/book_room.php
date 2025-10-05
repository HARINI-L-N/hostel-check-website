<?php
include '../config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}
include '../includes/header.php';

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];

    // Check availability
    $check = $conn->prepare("SELECT available FROM rooms WHERE id=?");
    $check->bind_param("i", $room_id);
    $check->execute();
    $result = $check->get_result()->fetch_assoc();

    if ($result['available'] > 0) {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $room_id);
        $stmt->execute();

        // Reduce room availability
        $update = $conn->prepare("UPDATE rooms SET available = available - 1 WHERE id=?");
        $update->bind_param("i", $room_id);
        $update->execute();

        echo "<p style='color:green;'>Room booked successfully!</p>";
    } else {
        echo "<p style='color:red;'>Room not available!</p>";
    }
}

// Fetch rooms
$rooms = $conn->query("SELECT * FROM rooms");
?>

<h2>Book a Room</h2>
<form method="POST">
    <label>Select Room:</label>
    <select name="room_id" required>
        <?php while($room = $rooms->fetch_assoc()): ?>
            <option value="<?php echo $room['id']; ?>">
                <?php echo $room['room_no'] . " (Available: " . $room['available'] . ")"; ?>
            </option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Book</button>
</form>

<?php include '../includes/footer.php'; ?>
