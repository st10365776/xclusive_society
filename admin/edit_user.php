<?php
session_start();
require_once '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: customers.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM tblUser WHERE userID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){
    header("Location: customers.php");
    exit();
}

$user = $result->fetch_assoc();

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    $update = $conn->prepare(
        "UPDATE tblUser SET name=?, email=? WHERE userID=?"
    );

    $update->bind_param("ssi", $name, $email, $id);

    if($update->execute()){
        header("Location: customers.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>

<style>

body{
    font-family:Arial;
    background:#121212;
    color:white;
    padding:40px;
}

form{
    max-width:400px;
    margin:auto;
    background:#1e1e1e;
    padding:30px;
    border-radius:10px;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:none;
    border-radius:5px;
}

button{
    padding:12px 20px;
    border:none;
    border-radius:5px;
    background:#ff3c3c;
    color:white;
    cursor:pointer;
}

button:hover{
    opacity:0.9;
}

</style>
</head>

<body>

<form method="POST">

<h2>Edit User</h2>

<input type="text"
name="name"
value="<?= htmlspecialchars($user['name']) ?>"
required>

<input type="email"
name="email"
value="<?= htmlspecialchars($user['email']) ?>"
required>

<button type="submit" name="update">
Update User
</button>

</form>

</body>
</html>