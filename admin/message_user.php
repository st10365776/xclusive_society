
<?php
session_start();
include '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

/*
|----------------------------------------------------------
| GET USER ID FROM URL
|----------------------------------------------------------
*/

if(!isset($_GET['userID'])){
    die("User not found.");
}

$userID = intval($_GET['userID']);

/*
|----------------------------------------------------------
| SEND MESSAGE
|----------------------------------------------------------
*/

if(isset($_POST['send'])){

    $message = trim($_POST['message']);

    if(!empty($message)){

        $adminID = 0; // Admin sender ID

        $stmt = $conn->prepare("
            INSERT INTO tblMessages
            (senderID, receiverID, message)
            VALUES (?, ?, ?)
        ");

        $stmt->bind_param(
            "iis",
            $adminID,
            $userID,
            $message
        );

        $stmt->execute();
    }
}

/*
|----------------------------------------------------------
| GET CHAT
|----------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT *
    FROM tblMessages
    WHERE 
    (senderID = 0 AND receiverID = ?)
    OR
    (senderID = ? AND receiverID = 0)
    ORDER BY createdAt ASC
");

$stmt->bind_param("ii", $userID, $userID);
$stmt->execute();

$messages = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>

<title>Seller Messages</title>

<style>

body{
    font-family:Arial;
    background:#ece5dd;
    margin:0;
}

.chat-container{
    max-width:800px;
    margin:40px auto;
    background:white;
    border-radius:10px;
    padding:20px;
}

.messages{
    height:500px;
    overflow-y:auto;
    padding:10px;
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
    background:#f1f1f1;
    margin-right:auto;
}

.time{
    font-size:12px;
    color:gray;
    margin-top:5px;
}

form{
    display:flex;
    gap:10px;
    margin-top:20px;
}

input{
    flex:1;
    padding:12px;
}

button{
    background:black;
    color:white;
    border:none;
    padding:12px 20px;
    cursor:pointer;
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
<a href="seller_submissions.php" class="back">
← Back to seller submissions
</a>

<div class="chat-container">

<h2>Chat With Seller</h2>

<div class="messages">

<?php while($msg = $messages->fetch_assoc()): ?>

<div class="message <?= $msg['senderID'] == 0 ? 'admin' : 'user' ?>">

<?= htmlspecialchars($msg['message']) ?>

<div class="time">
<?= $msg['createdAt'] ?>
</div>

</div>

<?php endwhile; ?>

</div>

<form method="POST">

<input type="text"
name="message"
placeholder="Type message..."
required>

<button type="submit" name="send">
Send
</button>

</form>

</div>

</body>
</html>
