<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
</head>
<body>
    <?php
    /**
     * ADD NEW USER/CUSTOMER
     * ====================
     * Allows admin to create new user accounts.
     * Inserts new user into tblUser with verified=1 (auto-approved by admin).
     * Redirects to manage_users.php after successful creation.
     */
    
    // Check if user is authenticated admin
    include 'admin_auth.php';
    include '../includes/DBConn.php';

    // Process form submission
    if($_POST){
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        // Hash password with MD5 (legacy method)
        $password = md5($_POST['password']);

        // Prepare insert statement
        $stmt = $conn->prepare(
            "INSERT INTO tblUser(name,email,password,verified)
             VALUES(?,?,?,1)"
        );

        // Bind parameters and execute
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();

        // Redirect to user management page
        header("Location: manage_users.php");
        exit();
    }
    ?>

    <!-- User creation form -->
    <form method="POST">
        <!-- User full name input -->
        <input name="name" placeholder="Name" required>
        <!-- User email input -->
        <input name="email" placeholder="Email" type="email" required>
        <!-- User password input -->
        <input name="password" placeholder="Password" type="password" required>
        <!-- Submit button -->
        <button>Add User</button>
    </form>
</body>
</html>