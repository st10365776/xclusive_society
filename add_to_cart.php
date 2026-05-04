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

$id = $_GET['id'];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]++;
}else{
    $_SESSION['cart'][$id] = 1;
}

header("Location: cart.php");
exit();
?>
</body>
</html>