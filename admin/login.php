<?php
session_start();
require_once '../includes/DBConn.php';

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $emailColumn = "adminEmail";
    $columnCheck = $conn->query("SHOW COLUMNS FROM tblAdmin LIKE 'adminEmail'");
    if (!$columnCheck || $columnCheck->num_rows === 0) {
        $emailColumn = "username";
    }

    $sql = "SELECT * FROM tblAdmin WHERE $emailColumn=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $admin = $result->fetch_assoc();
        $storedPassword = $admin['password'];
        $validPassword = password_verify($password, $storedPassword) || md5($password) === $storedPassword;

        if ($validPassword) {
            $_SESSION['admin'] = true;
            $_SESSION['adminID'] = $admin['adminID'];
            $_SESSION['admin_email'] = $email;

            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Invalid Login";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
font-family:Arial;
background:#111;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.login-card{
background:#1f1f1f;
padding:40px;
border-radius:10px;
width:300px;
color:white;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:5px;
}

button{
width:100%;
padding:12px;
background:#ff3c3c;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}
.error{color:red;}
</style>

</head>

<body>

<div class="login-card">

<h2>Admin Login</h2>

<?php if($error): ?>
<p class="error"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
<input name="email" type="email" placeholder="Admin Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

</div>

</body>
</html>
