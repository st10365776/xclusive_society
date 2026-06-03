<?php
session_start();
include 'includes/DBConn.php';

/*
|--------------------------------------------------------------------------
| CHECK LOGIN
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['userID'])){
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['userID'];

/*
|--------------------------------------------------------------------------
| SEND REPLY TO ADMIN
|--------------------------------------------------------------------------
*/

if(isset($_POST['send_reply'])){

    $message = trim($_POST['reply']);

    // Admin ID
    $adminID = 0;

    if(!empty($message)){

        $reply = $conn->prepare("
            INSERT INTO tblMessages
            (
                senderID,
                receiverID,
                message
            )
            VALUES (?, ?, ?)
        ");

        $reply->bind_param(
            "iis",
            $userID,
            $adminID,
            $message
        );

        $reply->execute();
    }
}

/*
|--------------------------------------------------------------------------
| MARK USER MESSAGES AS READ
|--------------------------------------------------------------------------
*/

$read = $conn->prepare("
    UPDATE tblMessages
    SET isRead = 1
    WHERE receiverID = ?
");

$read->bind_param("i", $userID);
$read->execute();

/*
|--------------------------------------------------------------------------
| GET ALL MESSAGES
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT *
    FROM tblMessages
    WHERE senderID = ?
    OR receiverID = ?
    ORDER BY createdAt ASC
");

$stmt->bind_param("ii", $userID, $userID);
$stmt->execute();

$messages = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Messages</title>

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#ece5dd;
}

/* MAIN CHAT CONTAINER */
.chat-container{
    max-width:700px;
    margin:40px auto;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

/* HEADER */
.chat-header{
    background:#111;
    color:white;
    padding:20px;
    font-size:22px;
    font-weight:bold;
}

/* CHAT AREA */
.chat-box{
    padding:20px;
    height:500px;
    overflow-y:auto;
    background:#e5ddd5;
}

/* MESSAGE */
.message{
    padding:12px 15px;
    border-radius:12px;
    margin-bottom:15px;
    width:fit-content;
    max-width:75%;
    word-wrap:break-word;
}

/* USER MESSAGE */
.user{
    background:#dcf8c6;
    margin-left:auto;
    text-align:left;
}

/* ADMIN MESSAGE */
.admin{
    background:white;
    margin-right:auto;
    border:1px solid #ddd;
}

/* TIME */
.time{
    font-size:11px;
    color:gray;
    margin-top:6px;
}

/* FORM AREA */
.chat-form{
    padding:20px;
    background:white;
    border-top:1px solid #ddd;
}

/* TEXTAREA */
.chat-form textarea{
    width:100%;
    height:90px;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    resize:none;
    font-size:14px;
    box-sizing:border-box;
}

/* SEND BUTTON */
.chat-form button{
    margin-top:10px;
    background:#111;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-size:15px;
    transition:0.3s;
}

.chat-form button:hover{
    background:#333;
}

/* EMPTY MESSAGE */
.empty{
    text-align:center;
    color:gray;
    margin-top:50px;
}
.back{
    display:inline-block;
    margin:20px;
    text-decoration:none;
    color:black;
    font-weight:bold;
}

</style>

</head>

<body>
<a href="profile.php" class="back">
← Back to profile
</a>
<div class="chat-container">

    <!-- HEADER -->
    <div class="chat-header">
        Messages
    </div>

    <!-- CHAT BOX -->
    <div class="chat-box">

        <?php if($messages->num_rows > 0): ?>

            <?php while($msg = $messages->fetch_assoc()): ?>

                <div class="message <?= $msg['senderID'] == $userID ? 'user' : 'admin' ?>">

                    <?= nl2br(htmlspecialchars($msg['message'])) ?>

                    <div class="time">
                        <?= $msg['createdAt'] ?>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="empty">
                No messages yet.
            </div>

        <?php endif; ?>

    </div>

    <!-- MESSAGE FORM -->
    <div class="chat-form">

        <form method="POST">

            <textarea
                name="reply"
                placeholder="Type your message..."
                required>
            </textarea>

            <button type="submit" name="send_reply">
                Send Message
            </button>

        </form>

    </div>

</div>

</body>
</html>