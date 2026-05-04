<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logout</title>
</head>
<body>
    <?php
    /**
     * USER LOGOUT PAGE
     * ================
     * Handles user session destruction and redirects to login page.
     * Clears all session variables and destroys the session.
     */
    
    session_start();
    // Destroy the entire session
    session_destroy();

    // Redirect user back to login page
    header("Location: login.php");
    ?>
</body>
</html>