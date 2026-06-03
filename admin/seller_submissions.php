<?php
session_start();
require_once '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$submissions = $conn->query(
    "SELECT * FROM tblSellerSubmissions
     ORDER BY submissionID DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Seller Submissions</title>

<style>
body{margin:0;font-family:Arial;background:#121212;color:white;}
.admin-layout{display:flex;min-height:100vh;}
.sidebar{width:220px;background:#1e1e1e;padding:20px;}
.sidebar a{display:block;color:white;padding:12px;text-decoration:none;margin-bottom:10px;border-radius:6px;background:#2a2a2a;}
.sidebar a:hover{background:#ff3c3c;}
.logout{background:#ff3c3c;}
.content{flex:1;padding:40px;}
.card{background:#1e1e1e;padding:20px;border-radius:10px;margin-bottom:24px;}
.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;}
label{display:block;font-size:14px;margin-bottom:6px;color:#ddd;}
input,select,textarea{width:100%;box-sizing:border-box;padding:10px;border:none;border-radius:5px;background:#2a2a2a;color:white;}
textarea{min-height:100px;resize:vertical;}
.full{grid-column:1 / -1;}
button{padding:10px 14px;border:none;border-radius:5px;cursor:pointer;background:#ff3c3c;color:white;}
.button-link{display:inline-block;padding:9px 12px;border-radius:5px;background:#2a2a2a;color:white;text-decoration:none;margin-right:6px;}
.button-link:hover{background:#ff3c3c;}
.delete-btn{background:#b91c1c;margin-top:6px;}
.inline-form{display:inline;}
table{width:100%;border-collapse:collapse;}
th,td{padding:12px;border-bottom:1px solid #333;text-align:left;vertical-align:top;}
.product-img{width:70px;height:70px;object-fit:cover;border-radius:6px;background:#2a2a2a;}
.message{color:#6ee76e;}
.error{color:#ff7373;}
.muted{color:#aaa;font-size:13px;}
body{
    font-family:Arial;
    background:#121212;
    color:white;
}

.container{
    width:90%;
    margin:auto;
    padding:40px;
}

.card{
    background:#1e1e1e;
    padding:20px;
    margin-bottom:20px;
    border-radius:10px;
}

img{
    width:150px;
    border-radius:10px;
}

button{
    padding:10px 15px;
    border:none;
    cursor:pointer;
    margin-right:10px;
}

.approve{
    background:green;
    color:white;
}

.reject{
    background:red;
    color:white;
}

</style>
</head>

<body>
<div class="admin-layout">
<div class="sidebar">
<h2>Admin Panel</h2>
<a href="dashboard.php">Dashboard</a>
<a href="customers.php">Customers</a>
<a href="products.php">Products</a>
<a href="seller_submissions.php">Seller Submissions</a>
<a href="logout.php" class="logout">Logout</a>
</div>
<div class="container">

<h1>Seller Submissions</h1>

<?php while($item = $submissions->fetch_assoc()): ?>

<div class="card">

<h2><?= htmlspecialchars($item['itemName']) ?></h2>

<img src="../<?= $item['imagePath'] ?>">

<p><strong>Brand:</strong>
<?= htmlspecialchars($item['brand']) ?></p>

<p><strong>Size:</strong>
<?= htmlspecialchars($item['size']) ?></p>

<p><strong>Condition:</strong>
<?= htmlspecialchars($item['itemCondition']) ?></p>

<p><strong>Description:</strong>
<?= htmlspecialchars($item['description']) ?></p>

<p><strong>Price:</strong>
R<?= $item['askingPrice'] ?></p>

<p><strong>Status:</strong>
<?= $item['status'] ?></p>

<a href="approve_submission.php?id=<?= $item['submissionID'] ?>">
<button class="approve">Approve</button>
</a>

<a href="reject_submission.php?id=<?= $item['submissionID'] ?>">
<button class="reject">Reject</button>
</a>
<a href="message_user.php?userID=<?= $item['userID'] ?>"> <button>Message Seller</button> </a>
</div>

<?php endwhile; ?>

</div>

</body>
</html>