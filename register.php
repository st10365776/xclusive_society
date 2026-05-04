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

    // Trim inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $passwordRaw = $_POST['password'];

    // Validation flags
    $errors = [];

    //  Name validation (letters + spaces only)
    if(empty($name)){
        $errors[] = "Full name is required.";
    } elseif(!preg_match("/^[a-zA-Z\s]{2,50}$/", $name)){
        $errors[] = "Name must contain only letters and spaces (2–50 characters).";
    }

    // Email validation
    if(empty($email)){
        $errors[] = "Email is required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }

    // Password validation (strong password)
    if(empty($passwordRaw)){
        $errors[] = "Password is required.";
    } elseif(strlen($passwordRaw) < 8){
        $errors[] = "Password must be at least 8 characters.";
    } elseif(!preg_match("/[A-Z]/", $passwordRaw)){
        $errors[] = "Password must include at least one uppercase letter.";
    } elseif(!preg_match("/[a-z]/", $passwordRaw)){
        $errors[] = "Password must include at least one lowercase letter.";
    } elseif(!preg_match("/[0-9]/", $passwordRaw)){
        $errors[] = "Password must include at least one number.";
    } elseif(!preg_match("/[\W]/", $passwordRaw)){
        $errors[] = "Password must include at least one special character.";
    }

    // If no errors → proceed
    if(empty($errors)){

        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM tblUser WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if($check->num_rows > 0){
            $message = "Email already exists.";
        } else {

            $sql = "INSERT INTO tblUser(name,email,password,verified)
                    VALUES(?,?,?,0)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss",$name,$email,$password);

            if($stmt->execute()){
                $message = "Registration successful. Waiting for admin approval.";
            } else {
                $message = "Something went wrong. Try again.";
            }
        }

    } else {
        // Show all errors
        $message = implode("<br>", $errors);
    }
}
?>

<?php include 'includes/header.php'; ?>

<section class="auth-container">

<form method="POST" class="auth-card">

<h2>Create Account</h2>

<input type="text" name="name" placeholder="Full Name"
       pattern="[A-Za-z\s]{2,50}"
       title="Only letters and spaces (2–50 characters)"
       required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password"
       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}"
       title="At least 8 characters, including uppercase, lowercase, number, and special character"
       required>

<button name="register" class="btn">Register</button>

<p>Already have an account? <a href="login.php">Login</a></p>

</form>

</section>

<?php include 'includes/footer.php'; ?>
</body>
<script>
const passwordInput = document.querySelector('input[name="password"]');

passwordInput.addEventListener('input', function() {
    const value = this.value;

    if(value.length < 8){
        this.style.borderColor = "red";
    } else if(!/[A-Z]/.test(value)){
        this.style.borderColor = "orange";
    } else if(!/[0-9]/.test(value)){
        this.style.borderColor = "yellow";
    } else {
        this.style.borderColor = "green";
    }
});
</script>
</html>