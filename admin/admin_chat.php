<?php
session_start();
include '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| GET USER ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET['userID'])){
    die("User not found.");
}

$userID = intval($_GET['userID']);

/*
|--------------------------------------------------------------------------
| GET USER DETAILS
|--------------------------------------------------------------------------
*/

$userStmt = $conn->prepare("
    SELECT *
    FROM tblUser
    WHERE userID = ?
");

$userStmt->bind_param("i", $userID);
$userStmt->execute();

$user = $userStmt->get_result()->fetch_assoc();

if(!$user){
    die("User not found.");
}

/*
|--------------------------------------------------------------------------
| SEND MESSAGE
|--------------------------------------------------------------------------
*/

if(isset($_POST['send'])){

    $message = trim($_POST['message']);

    if(!empty($message)){

        $stmt = $conn->prepare("
            INSERT INTO tblMessages
            (senderID, receiverID, message)
            VALUES (0, ?, ?)
        ");

        $stmt->bind_param(
            "is",
            $userID,
            $message
        );

        $stmt->execute();
    }
}

/*
|--------------------------------------------------------------------------
| MARK AS READ
|--------------------------------------------------------------------------
*/

$read = $conn->prepare("
    UPDATE tblMessages
    SET isRead = 1
    WHERE senderID = ?
    AND receiverID = 0
");

$read->bind_param("i", $userID);
$read->execute();

/*
|--------------------------------------------------------------------------
| GET CHAT
|--------------------------------------------------------------------------
*/

$chat = $conn->prepare("
    SELECT *
    FROM tblMessages
    WHERE 
    (senderID = 0 AND receiverID = ?)
    OR
    (senderID = ? AND receiverID = 0)
    ORDER BY createdAt ASC
");

$chat->bind_param("ii", $userID, $userID);
$chat->execute();

$messages = $chat->get_result();
?>

<!DOCTYPE html>
<html>
<head>

<title>Chat</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#ece5dd;
}

.chat-wrapper{
    max-width:900px;
    margin:30px auto;
    background:white;
    border-radius:10px;
    overflow:hidden;
}

.chat-header{
    background:#111;
    color:white;
    padding:20px;
}

.chat-box{
    height:500px;
    overflow-y:auto;
    padding:20px;
    background:#e5ddd5;
}

.message{
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:15px;
    max-width:70%;
    width:fit-content;
}

.admin{
    background:#dcf8c6;
    margin-left:auto;
}

.user{
    background:white;
    margin-right:auto;
}

.time{
    font-size:11px;
    color:gray;
    margin-top:5px;
}

.send-box{
    display:flex;
    padding:15px;
    background:#f0f0f0;
}

.send-box input{
    flex:1;
    padding:12px;
    border:none;
    border-radius:5px;
}

.send-box button{
    margin-left:10px;
    padding:12px 20px;
    border:none;
    background:#111;
    color:white;
    border-radius:5px;
    cursor:pointer;
}

.send-box button:hover{
    background:#ff3c3c;
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

<a href="admin_messages.php" class="back">
← Back to Messages
</a>

<div class="chat-wrapper">

<div class="chat-header">

<h2>
<?= htmlspecialchars($user['name']) ?>
</h2>

<p>
<?= htmlspecialchars($user['email']) ?>
</p>

</div>

<div class="chat-box">

<?php while($msg = $messages->fetch_assoc()): ?>

<div class="message <?= $msg['senderID'] == 0 ? 'admin' : 'user' ?>">

<?= htmlspecialchars($msg['message']) ?>

<div class="time">
<?= $msg['createdAt'] ?>
</div>

</div>

<?php endwhile; ?>

</div>

<form method="POST" class="send-box">

<input
type="text"
name="message"
placeholder="Type a message..."
required>

<button type="submit" name="send">
Send
</button>

</form>

</div>

</body>
</html>