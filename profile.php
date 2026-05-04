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

<section class="page-title">

<h1>Welcome <?= $_SESSION['name']; ?></h1>

<a href="logout.php" class="btn">Logout</a>

</section>

<?php include 'includes/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>

<h2>
User <?= $_SESSION['name']; ?> is logged in
</h2>

<section class="page-title">
<h1>Welcome <?php echo $_SESSION['name']; ?></h1>

<a href="logout.php" class="btn">Logout</a>

</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
</body>
</html>