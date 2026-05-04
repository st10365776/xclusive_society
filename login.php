<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
session_start();
include 'includes/DBConn.php';

$message = "";

$email = "";
$password = "";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM tblUser WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(! $user['verified']){
$message = "Account waiting for admin verification.";
}
else if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['userID'];
$_SESSION['name'] = $user['name'];

header("Location: profile.php");
exit();
}
else{
$message = "Incorrect password.";
}

}else{
$message = "User does not exist.";
}
}
?>

<?php include 'includes/header.php'; ?>

<section class="auth-container">

<form method="POST" class="auth-card">

<h2>Login</h2>

<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button name="login" class="btn">Login</button>

<p>No account? <a href="register.php">Register</a></p>

</form>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>