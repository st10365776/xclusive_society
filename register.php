<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
   <?php
session_start();
include 'includes/DBConn.php';

$message = "";

if(isset($_POST['register'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $passwordRaw = $_POST['password'];

    $errors = [];

    if(empty($name)){
        $errors[] = "Full name is required.";
    }

    if(empty($email)){
        $errors[] = "Email is required.";
    }

    if(empty($passwordRaw)){
        $errors[] = "Password is required.";
    }

    if(empty($errors)){

        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        $check = $conn->prepare("SELECT userID FROM tblUser WHERE email=?");
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

                // CLEAN REDIRECT (NOW IT WORKS)
                header("Location: login.php?registered=1");
                exit();

            } else {
                $message = "Something went wrong.";
            }
        }

    } else {
        $message = implode("<br>", $errors);
    }
}
?>

   <!-- Include navigation header -->
   <?php include 'includes/header.php'; ?>

   <!-- Registration form section -->
   <section class="auth-container">

       <form method="POST" class="auth-card">

           <h2>Create Account</h2>

           <!-- Input field for full name with validation -->
           <input type="text" name="name" placeholder="Full Name"
                  pattern="[A-Za-z\s]{2,50}"
                  title="Only letters and spaces (2–50 characters)"
                  required>

           <!-- Input field for email -->
           <input type="email" name="email" placeholder="Email" required>

           <!-- Input field for password with strength requirements -->
           <input type="password" name="password" placeholder="Password"
                  pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}"
                  title="At least 8 characters, including uppercase, lowercase, number, and special character"
                  required>

           <!-- Submit button -->
           <button name="register" class="btn">Register</button>

           <!-- Link to login page for existing users -->
           <p>Already have an account? <a href="login.php">Login</a></p>

       </form>

   </section>

   <!-- Include footer -->
   <?php include 'includes/footer.php'; ?>
</body>

<!-- JavaScript for real-time password strength feedback -->
<script>
// Get password input element
const passwordInput = document.querySelector('input[name="password"]');

// Listen for password input changes
passwordInput.addEventListener('input', function() {
    const value = this.value;

    // Color code the password input based on strength
    if(value.length < 8){
        this.style.borderColor = "red";  // Too short
    } else if(!/[A-Z]/.test(value)){
        this.style.borderColor = "orange";  // Missing uppercase
    } else if(!/[0-9]/.test(value)){
        this.style.borderColor = "yellow";  // Missing number
    } else {
        this.style.borderColor = "green";  // Strong password
    }
});
</script>

</html>