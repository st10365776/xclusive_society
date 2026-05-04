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
   /**
    * USER REGISTRATION PAGE
    * ======================
    * Handles user account creation with comprehensive validation:
    * - Name: letters and spaces only (2-50 characters)
    * - Email: valid email format, must be unique
    * - Password: strong password (8+ chars, uppercase, lowercase, number, special char)
    * 
    * New accounts start as unverified (verified=0) pending admin approval.
    */
   
   include 'includes/DBConn.php';

   $message = "";

   // Process registration form submission
   if(isset($_POST['register'])){

       // Trim whitespace from inputs
       $name = trim($_POST['name']);
       $email = trim($_POST['email']);
       $passwordRaw = $_POST['password'];

       // Array to store validation errors
       $errors = [];

       // Validate name (letters and spaces only)
       if(empty($name)){
           $errors[] = "Full name is required.";
       } elseif(!preg_match("/^[a-zA-Z\s]{2,50}$/", $name)){
           $errors[] = "Name must contain only letters and spaces (2–50 characters).";
       }

       // Validate email format
       if(empty($email)){
           $errors[] = "Email is required.";
       } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $errors[] = "Invalid email format.";
       }

       // Validate password strength
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

       // Proceed if no validation errors
       if(empty($errors)){

           // Hash password for secure storage
           $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

           // Check if email already exists in database
           $check = $conn->prepare("SELECT id FROM tblUser WHERE email = ?");
           $check->bind_param("s", $email);
           $check->execute();
           $check->store_result();

           if($check->num_rows > 0){
               $message = "Email already exists.";
           } else {

               // Insert new user into database with verified=0 (pending approval)
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
           // Display all validation errors
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