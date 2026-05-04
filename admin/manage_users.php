<?php
/**
 * MANAGE USERS / CUSTOMERS
 * ========================
 * Admin page to view all registered customers.
 * Displays list of users with options to:
 * - View user details
 * - Edit user information
 * - Delete user account
 * - Add new customer
 */

include 'admin_auth.php';
include '../includes/DBConn.php';

// Fetch all users from database
$users = $conn->query("SELECT * FROM tblUser");
?>

<h2>Customers</h2>

<!-- Link to add new customer -->
<a href="add_user.php">Add Customer</a>

<!-- List all customers -->
<?php while($u = $users->fetch_assoc()){ ?>

    <div>
        <!-- Display customer name and email -->
        <?= $u['name']; ?> | <?= $u['email']; ?>

        <!-- Edit customer link -->
        <a href="edit_user.php?id=<?= $u['userID']; ?>">Edit</a>
        <!-- Delete customer link -->
        <a href="delete_user.php?id=<?= $u['userID']; ?>">Delete</a>

    </div>

<?php } ?>