<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<?php
/**
 * USER LOGIN PAGE
 * ===============
 * Handles user authentication for the Xclusive Society platform.
 * Validates email and password, then redirects to user profile on success.
 * Uses password_verify() for secure password comparison.
 */

session_start();
include 'includes/DBConn.php';

$error = "";

// Process login form submission
if (isset($_POST['login'])) {

    // Get email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query database for user with matching email
    $sql = "SELECT * FROM tblUser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // Verify password against stored hash
        if (password_verify($password, $user['password'])) {

            // Set session variables on successful login
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['name'] = $user['name'];

            // Redirect to user profile page
            header("Location: profile.php");
            exit();

        } else {
            $error = "Invalid email or password";
        }

    } else {
        $error = "Invalid email or password";
    }
}
?>

<!-- Include navigation header -->
<?php include 'includes/header.php'; ?>

<!-- Login form section -->
<section class="auth-container">

    <form method="POST" class="auth-card">

        <h2>Login</h2>

        <!-- Display error message if login failed -->
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login" class="btn">Login</button>

        <!-- Link to registration page for new users -->
        <p>No account? <a href="register.php">Register</a></p>

    </form>

</section>

<!-- Include footer -->
<?php include 'includes/footer.php'; ?>
</body>
</html>