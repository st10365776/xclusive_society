
<?php
session_start();
include '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/*
|----------------------------------------------------------
| GET ALL CONVERSATIONS
|----------------------------------------------------------
*/

$query = $conn->query("
    SELECT 
        u.userID,
        u.name,
        u.email,

        (
            SELECT message
            FROM tblMessages m
            WHERE m.senderID = u.userID
            OR m.receiverID = u.userID
            ORDER BY createdAt DESC
            LIMIT 1
        ) AS lastMessage,

        (
            SELECT COUNT(*)
            FROM tblMessages m2
            WHERE m2.senderID = u.userID
            AND m2.receiverID = 0
            AND m2.isRead = 0
        ) AS unreadCount

    FROM tblUser u

    WHERE EXISTS (
        SELECT 1
        FROM tblMessages m3
        WHERE m3.senderID = u.userID
        OR m3.receiverID = u.userID
    )

    ORDER BY unreadCount DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Messages</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#121212;
    color:white;
}

.container{
    max-width:900px;
    margin:40px auto;
}

.chat-card{
    background:#1e1e1e;
    padding:20px;
    border-radius:10px;
    margin-bottom:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.user-info h3{
    margin:0;
}

.user-info p{
    color:#aaa;
    margin-top:5px;
}

.last-message{
    margin-top:10px;
    color:#ddd;
}

.open-btn{
    background:#25d366;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:6px;
}

.badge{
    background:red;
    padding:4px 8px;
    border-radius:50%;
    font-size:12px;
    margin-left:10px;
}
.back{
    display:inline-block;
    margin:20px;
    text-decoration:none;
    color:White;
    font-weight:bold;
}


</style>

</head>

<body>
<a href="dashboard.php" class="back">
← Back to Dashboard
</a>
<div class="container">

<h1>Seller Messages</h1>

<?php while($row = $query->fetch_assoc()): ?>

<div class="chat-card">

    <div class="user-info">

        <h3>
            <?= htmlspecialchars($row['name']) ?>

            <?php if($row['unreadCount'] > 0): ?>
                <span class="badge">
                    <?= $row['unreadCount'] ?>
                </span>
            <?php endif; ?>

        </h3>

        <p>
            <?= htmlspecialchars($row['email']) ?>
        </p>

        <div class="last-message">
            <?= htmlspecialchars($row['lastMessage']) ?>
        </div>

    </div>

    <a href="admin_chat.php?userID=<?= $row['userID'] ?>"
       class="open-btn">

       Open Chat

    </a>

</div>

<?php endwhile; ?>

</div>

</body>
</html>

