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

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<?php include 'includes/header.php'; ?>

<h1>Welcome <?= $_SESSION['name']; ?></h1>

<a href="logout.php">Logout</a>

<?php include 'includes/footer.php'; ?>

<a href="logout.php">Logout</a>

</body>
</html>
</body>
</html>