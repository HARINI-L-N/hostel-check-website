<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/hostel-check/css/reset.css">
<link rel="stylesheet" href="/hostel-check/css/style.css">
<link rel="stylesheet" href="/hostel-check/css/animations.css">

    <meta charset="UTF-8">
    <title>Hostel Management</title>
    <link rel="stylesheet" href="/hostel-check/css/style.css">
</head>
<body>
<nav>
    <a href="/hostel-check/index.php">Home</a>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/hostel-check/logout.php">Logout</a>
    <?php else: ?>
        <a href="/hostel-check/login.php">Login</a>
    <?php endif; ?>
</nav>
<hr>
