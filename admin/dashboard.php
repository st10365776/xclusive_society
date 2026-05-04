<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>

body{margin:0;font-family:Arial;background:#121212;color:white;}

.admin-layout{
display:flex;
height:100vh;
}

.sidebar{
width:220px;
background:#1e1e1e;
padding:20px;
}

.sidebar a{
display:block;
color:white;
padding:12px;
text-decoration:none;
margin-bottom:10px;
border-radius:6px;
background:#2a2a2a;
}

.sidebar a:hover{
background:#ff3c3c;
}

.logout{
background:#ff3c3c;
}

.content{
flex:1;
padding:40px;
}

.card{
background:#1e1e1e;
padding:30px;
border-radius:10px;
}

</style>
</head>

<body>

<div class="admin-layout">

<div class="sidebar">
<h2>Admin Panel</h2>

<a href="dashboard.php">Dashboard</a>
<a href="customers.php">Customers</a>
<a href="logout.php" class="logout">Logout</a>
</div>

<div class="content">

<div class="card">
<h1>Welcome <?= $_SESSION['admin_username']; ?> 👑</h1>
<p>Xclusive Society Admin Dashboard</p>
</div>

</div>

</div>

</body>
</html>