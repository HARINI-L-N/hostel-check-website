
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostel Check</title>
    <link rel="stylesheet" href="/hostel-check/css/reset.css">
    <link rel="stylesheet" href="/hostel-check/css/style.css">
    <link rel="stylesheet" href="/hostel-check/css/animations.css">
</head>
<body>
<nav>
    <a href="/hostel-check/index.php">Home</a>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="/hostel-check/admin/dashboard.php">Admin Dashboard</a>
    <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'student'): ?>
        <a href="/hostel-check/students/dashboard.php">Student Dashboard</a>
    <?php endif; ?>
    <?php if(isset($_SESSION['name'])): ?>
        <span style="margin-left:20px;">Welcome, <?php echo $_SESSION['name']; ?></span>
        <a href="/hostel-check/logout.php" style="float:right;">Logout</a>
    <?php else: ?>
        <a href="/hostel-check/login.php" style="float:right;">Login</a>
    <?php endif; ?>
</nav>
