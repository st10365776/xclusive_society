<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/DBConn.php';

/*
|--------------------------------------------------------------------------
| USER NOTIFICATIONS
|--------------------------------------------------------------------------
*/

$unread = 0;

if(isset($_SESSION['userID'])){

    $userID = $_SESSION['userID'];

    $stmt = $conn->prepare("
        SELECT COUNT(*) AS total
        FROM tblMessages
        WHERE receiverID = ?
        AND isRead = 0
    ");

    $stmt->bind_param("i", $userID);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $unread = $data['total'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Xclusive Society</title>

<link rel="stylesheet" href="style.css">

<style>

.notification-link{
    position:relative;
}

.notif-badge{
    position:absolute;
    top:-8px;
    right:-10px;
    background:red;
    color:white;
    border-radius:50%;
    padding:3px 7px;
    font-size:11px;
    font-weight:bold;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">

    <!-- LOGO -->
    <div class="logo">
        <a href="index.php">
            <img src="images/logo.png" alt="Logo">
        </a>
    </div>

    <!-- NAV LINKS -->
    <ul class="nav-links">
        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="new.php">New</a>
        </li>
    
        <li>
            <a href="men.php">Men</a>
        </li>

        <li>
            <a href="women.php">Women</a>
        </li>

        <li>
            <a href="kids.php">Kids</a>
        </li>

    </ul>

    <!-- ICONS -->
    <div class="icons">

    <a href="cart.php">🛒</a>

    <?php if(isset($_SESSION['userID'])): ?>

        <a href="profile.php">👤</a>

        <a href="messages.php" class="notification-link">

            💬

            <?php if($unread > 0): ?>
                <span class="notif-badge">
                    <?= $unread ?>
                </span>
            <?php endif; ?>

        </a>

    <?php endif; ?>

    <a href="login.php">Login</a>

    <a href="admin/login.php">Admin</a>

</div>

</nav>
