<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Order History</title>
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
   
   // Fetch user information
   $sql = "SELECT name FROM tblUser WHERE userID = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("i", $userID);
   $stmt->execute();
   $user = $stmt->get_result()->fetch_assoc();
   ?>

   <!-- Include navigation header -->
   <?php include 'includes/header.php'; ?>

   <div class="order-history-container">
       <div class="order-history-header">
           <h1>📋 Order History</h1>
           <p class="header-subtitle">All your orders</p>
       </div>

       <!-- Back to Profile Button -->
       <a href="profile.php" class="back-to-profile">← Back to Profile</a>

       <!-- Orders Section -->
       <div class="orders-section">
           <?php
           // Fetch all orders for this user, sorted by most recent first
           $orderSQL = "SELECT * FROM tblAorder WHERE userID = ? ORDER BY orderDate DESC";
           $stmt = $conn->prepare($orderSQL);
           $stmt->bind_param("i", $userID);
           $stmt->execute();
           $orders = $stmt->get_result();

           // Check if user has any orders
           if ($orders->num_rows == 0) {
               echo "<div class='no-orders'>";
               echo "<p>You haven't placed any orders yet.</p>";
               echo "<a href='index.php' class='continue-shopping'>Start Shopping</a>";
               echo "</div>";
           } else {
               echo "<table class='orders-table'>";
               echo "<thead>";
               echo "<tr>";
               echo "<th>Order ID</th>";
               echo "<th>Date</th>";
               echo "<th>Total</th>";
               echo "<th>Status</th>";
               echo "<th>Actions</th>";
               echo "</tr>";
               echo "</thead>";
               echo "<tbody>";

               // Display each order
               while ($order = $orders->fetch_assoc()) {
                   $orderID = $order['orderID'];
                   $orderDate = date('M d, Y', strtotime($order['orderDate']));
                   $total = 'R' . number_format($order['total'], 2);
                   $status = htmlspecialchars($order['status']);
                   
                   // Determine status class for styling
                   $statusClass = '';
                   switch(strtolower($status)) {
                       case 'pending':
                           $statusClass = 'status-pending';
                           break;
                       case 'completed':
                           $statusClass = 'status-completed';
                           break;
                       case 'cancelled':
                           $statusClass = 'status-cancelled';
                           break;
                       case 'processing':
                           $statusClass = 'status-processing';
                           break;
                       default:
                           $statusClass = 'status-default';
                   }

                   echo "<tr>";
                   echo "<td class='order-id'>#" . htmlspecialchars($orderID) . "</td>";
                   echo "<td>" . $orderDate . "</td>";
                   echo "<td class='order-total'>" . $total . "</td>";
                   echo "<td><span class='status-badge $statusClass'>$status</span></td>";
                   echo "<td class='order-actions'>";
                   
                   // Show cancel button only if order status is not cancelled or completed
                   if (strtolower($status) !== 'cancelled' && strtolower($status) !== 'completed') {
                       echo "<a href='cancel-order.php?orderID=" . htmlspecialchars($orderID) . "' class='action-btn cancel-btn' onclick=\"return confirm('Cancel this order?')\">Cancel</a>";
                   }
                   
                   echo "<a href='order-details.php?orderID=" . htmlspecialchars($orderID) . "' class='action-btn view-btn'>View Details</a>";
                   echo "</td>";
                   echo "</tr>";
               }

               echo "</tbody>";
               echo "</table>";
           }
           ?>
       </div>
   </div>

   <!-- Include footer -->
   <?php include 'includes/footer.php'; ?>

</body>
</html>
