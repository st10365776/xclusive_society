
<?php
session_start();
include '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/*
|----------------------------------------------------------
| GET UNREAD NOTIFICATIONS
|----------------------------------------------------------
*/

$notifQuery = $conn->query("
    SELECT COUNT(*) AS total
    FROM tblMessages
    WHERE receiverID = 0
    AND isRead = 0
");

$notif = $notifQuery->fetch_assoc();
$unread = $notif['total'];

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#121212;
    color:white;
}

.admin-layout{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */

.sidebar{
    width:240px;
    background:#1e1e1e;
    padding:20px;
}

.sidebar h2{
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px;
    text-decoration:none;
    margin-bottom:10px;
    border-radius:6px;
    background:#2a2a2a;
    transition:0.3s;
}

.sidebar a:hover{
    background:#ff3c3c;
}

/* LOGOUT BUTTON */

.logout{
    background:#ff3c3c !important;
}

/* CONTENT */

.content{
    flex:1;
    padding:40px;
}

/* CARD */

.card{
    background:#1e1e1e;
    padding:30px;
    border-radius:10px;
}

/* NOTIFICATION */

.notification-link{
    position:relative;
}

.notif-badge{
    position:absolute;
    top:8px;
    right:10px;
    background:red;
    color:white;
    border-radius:50%;
    padding:3px 8px;
    font-size:12px;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>Admin Panel</h2>

        <a href="dashboard.php">Dashboard</a>

        <a href="customers.php">Customers</a>

        <a href="products.php">Products</a>

        <a href="seller_submissions.php">
            Seller Submissions
        </a>

        <!-- NOTIFICATIONS -->
        <a href="admin_messages.php"
           class="notification-link">

            🔔 Notifications

            <?php if($unread > 0): ?>
                <span class="notif-badge">
                    <?= $unread ?>
                </span>
            <?php endif; ?>

        </a>

        <a href="logout.php"
           class="logout">
           Logout
        </a>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="card">

            <h1>
                Welcome
                <?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin'); ?>
                👑
            </h1>

            <p>
                Xclusive Society Admin Dashboard
            </p>

            <br>

            <p>
                <a href="products.php"
                   style="color:#ff3c3c;">
                   Add or manage products
                </a>
            </p>

        </div>

    </div>

</div>

</body>
</html>
