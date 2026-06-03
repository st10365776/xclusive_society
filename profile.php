<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>
<body>
   <?php
   
   
   session_start();
   include 'includes/DBConn.php';

   // Redirect to login if user is not authenticated
   if (!isset($_SESSION['userID'])) {
       header("Location: login.php");
       exit();
   }

   $userID = $_SESSION['userID'];
   ?>

   <!-- Include navigation header -->
   <?php include 'includes/header.php'; ?>

   <div class="profile-container">

       <!-- USER INFORMATION SECTION -->
       <div class="profile-card">

           <?php
           // Fetch user information from database
           $sql = "SELECT * FROM tblUser WHERE userID = ?";
           $stmt = $conn->prepare($sql);
           $stmt->bind_param("i", $userID);
           $stmt->execute();
           $user = $stmt->get_result()->fetch_assoc();
           ?>

           <!-- Welcome message -->
<h2>Welcome, <?= htmlspecialchars($user['name']); ?> 👋</h2>

<p class="profile-email">
    <?= htmlspecialchars($user['email']); ?>
</p>

<h3>User Details</h3>

<table class="profile-table">

    <tr>
        <th>Column Name</th>
        <th>Value</th>
    </tr>

    <?php foreach($user as $column => $value): ?>

        <?php if($column == 'password') continue; ?>

        <tr>
            <td><?= htmlspecialchars($column); ?></td>
            <td><?= htmlspecialchars($value); ?></td>
        </tr>

    <?php endforeach; ?>

</table>

<a href="logout.php" class="logout">Logout</a>
<a href="seller_submission.php" class="sell-btn">
    Sell Product
</a>
       </div>

       <!-- ORDERS SECTION -->
       <div class="profile-card">

           <h2>Your Orders</h2>

           <?php
           // Fetch all orders for this user, sorted by most recent first
           $orderSQL = "SELECT * FROM tblAorder WHERE userID = ? ORDER BY orderID DESC";
           $stmt = $conn->prepare($orderSQL);
           $stmt->bind_param("i", $userID);
           $stmt->execute();
           $orders = $stmt->get_result();

           // Check if user has any orders
           if ($orders->num_rows == 0) {
               echo "<p>No orders yet.</p>";
           } else {

               // Display each order
               while ($order = $orders->fetch_assoc()) {
                   ?>

                   <div class="order-card">

                       <!-- Order ID and status -->
                       <div class="order-header">
                           <span>Order #<?= $order['orderID']; ?></span>
                           <span class="status"><?= htmlspecialchars($order['status']); ?></span>
                       </div>

                       <!-- Order total amount -->
                       <p>Total: R<?= $order['total']; ?></p>
                       <!-- Order date -->
                       <p>Date: <?= $order['orderDate']; ?></p>

                       <!-- Button to cancel order -->
                       <a class="cancel-btn"
                          href="cancel-order.php?orderID=<?= $order['orderID']; ?>"
                          onclick="return confirm('Cancel this order?')">
                          Cancel Order
                       </a>

                   </div>

                   <?php
               }
           }
           ?>

       </div>

   </div>

   <!-- Include footer -->
   <?php include 'includes/footer.php'; ?>

</body>
</html>
