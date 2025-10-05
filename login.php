<?php
session_start();
include 'config.php';

$error = '';
$use_hashed_passwords = false; // set true if your DB has bcrypt hashed passwords

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($use_hashed_passwords) {
            // bcrypt password check
            if (password_verify($password, $user['password'])) {
                $login_success = true;
            } else {
                $login_success = false;
            }
        } else {
            // plain text password check
            if ($password === $user['password']) {
                $login_success = true;
            } else {
                $login_success = false;
            }
        }

        if ($login_success) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];

            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: students/dashboard.php");
            }
            exit;
        } else {
            $error = "Incorrect password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<h2>Login</h2>
<form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>

<?php include 'includes/footer.php'; ?>
