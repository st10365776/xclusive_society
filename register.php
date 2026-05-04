<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
include 'includes/DBConn.php';

$message = "";

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO tblUser(name,email,password,verified)
        VALUES(?,?,?,0)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss",$name,$email,$password);

if($stmt->execute()){
$message = "Registration successful. Waiting for admin approval.";
}
}
?>

<?php include 'includes/header.php'; ?>

<section class="auth-container">

<form method="POST" class="auth-card">

<h2>Create Account</h2>

<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button name="register" class="btn">Register</button>

<p>Already have an account? <a href="login.php">Login</a></p>

</form>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>