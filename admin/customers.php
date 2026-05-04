<?php
session_start();
require_once '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$users = $conn->query("SELECT * FROM tblUser ORDER BY userID DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Customers</title>

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

.logout{background:#ff3c3c;}

.content{
flex:1;
padding:40px;
}

.card{
background:#1e1e1e;
padding:20px;
border-radius:10px;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
border-bottom:1px solid #333;
}

button{
padding:6px 10px;
border:none;
border-radius:5px;
cursor:pointer;
}

.verify{background:green;color:white;}
.delete{background:red;color:white;}

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

<h2>Customers</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Verified</th>
<th>Actions</th>
</tr>

<?php while($user=$users->fetch_assoc()): ?>

<tr>
<td><?= $user['userID'] ?></td>
<td><?= htmlspecialchars($user['name']) ?></td>
<td><?= htmlspecialchars($user['email']) ?></td>

<td>
<?= $user['verified'] ? "✅ Verified" : "⏳ Pending" ?>
</td>

<td>

<?php if(!$user['verified']): ?>
<a href="/xclusive_society/admin/verify_users.php?id=<?= $user['userID']; ?>">
    <button class="verify">Verify</button>
</a>
<?php endif; ?>

<a href="delete_user.php?id=<?= $user['userID'] ?>"
onclick="return confirm('Delete user?')">
<button class="delete">Delete</button>
</a>

</td>
</tr>

<?php endwhile; ?>

</table>

</div>
</div>

</div>

</body>
</html>