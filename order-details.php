<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Order Details</title>
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
   
   // Check if orderID is provided
   if (!isset($_GET['orderID']) || empty($_GET['orderID'])) {
       header("Location: order-history.php");
       exit();
   }

   $orderID = (int)$_GET['orderID'];

   // Fetch order information
   $orderSQL = "SELECT * FROM tblAorder WHERE orderID = ? AND userID = ?";
   $stmt = $conn->prepare($orderSQL);
   $stmt->bind_param("ii", $orderID, $userID);
   $stmt->execute();
   $orderResult = $stmt->get_result();

   // Check if order exists
   if ($orderResult->num_rows == 0) {
       header("Location: order-history.php");
       exit();
   }

   $order = $orderResult->fetch_assoc();
   ?>

   <!-- Include navigation header -->
   <?php include 'includes/header.php'; ?>

   <div class="order-details-container">
       <!-- Back Navigation -->
       <a href="order-history.php" class="back-link">← Back to Order History</a>

       <!-- Order Header -->
       <div class="order-details-header">
           <div class="header-left">
               <h1>Order #<?= htmlspecialchars($order['orderID']); ?></h1>
               <p class="order-date">Placed on <?= date('F d, Y', strtotime($order['orderDate'])); ?></p>
           </div>
           <div class="header-right">
               <div class="status-container">
                   <?php
                   $status = htmlspecialchars($order['status']);
                   $statusClass = '';
                   $statusIcon = '';
                   
                   switch(strtolower($status)) {
                       case 'pending':
                           $statusClass = 'status-pending';
                           $statusIcon = '⏳';
                           break;
                       case 'completed':
                           $statusClass = 'status-completed';
                           $statusIcon = '✓';
                           break;
                       case 'cancelled':
                           $statusClass = 'status-cancelled';
                           $statusIcon = '✕';
                           break;
                       case 'processing':
                           $statusClass = 'status-processing';
                           $statusIcon = '📦';
                           break;
                       default:
                           $statusClass = 'status-default';
                           $statusIcon = '•';
                   }
                   ?>
                   <span class="status-badge large <?= $statusClass; ?>">
                       <?= $statusIcon; ?> <?= $status; ?>
                   </span>
               </div>
           </div>
       </div>

       <!-- Order Summary -->
       <div class="order-summary-section">
           <div class="summary-card">
               <h3>Order Summary</h3>
               <div class="summary-row">
                   <span class="summary-label">Subtotal:</span>
                   <span class="summary-value">R<?= number_format($order['total'], 2); ?></span>
               </div>
               <div class="summary-row">
                   <span class="summary-label">Shipping:</span>
                   <span class="summary-value">R<?= number_format($order['shipping'] ?? 0, 2); ?></span>
               </div>
               <div class="summary-row total">
                   <span class="summary-label">Total:</span>
                   <span class="summary-value">R<?= number_format($order['total'] + ($order['shipping'] ?? 0), 2); ?></span>
               </div>
           </div>
       </div>

       <!-- Order Items Section -->
       <div class="order-items-section">
           <h2>Items in This Order</h2>
           
           <?php
           // Fetch order items (assuming items are stored in a tblOrderItems table)
           // If your database structure is different, adjust the query accordingly
           $itemsSQL = "SELECT * FROM tblOrderItems WHERE orderID = ?";
           $stmt = $conn->prepare($itemsSQL);
           
           if ($stmt) {
               $stmt->bind_param("i", $orderID);
               $stmt->execute();
               $itemsResult = $stmt->get_result();

               if ($itemsResult->num_rows > 0) {
                   echo "<table class='items-table'>";
                   echo "<thead>";
                   echo "<tr>";
                   echo "<th>Product</th>";
                   echo "<th>Size</th>";
                   echo "<th>Quantity</th>";
                   echo "<th>Price</th>";
                   echo "<th>Subtotal</th>";
                   echo "</tr>";
                   echo "</thead>";
                   echo "<tbody>";

                   while ($item = $itemsResult->fetch_assoc()) {
                       $itemSubtotal = $item['price'] * $item['quantity'];
                       echo "<tr>";
                       echo "<td>" . htmlspecialchars($item['productName']) . "</td>";
                       echo "<td>" . htmlspecialchars($item['size'] ?? 'N/A') . "</td>";
                       echo "<td class='quantity'>" . (int)$item['quantity'] . "</td>";
                       echo "<td>R" . number_format($item['price'], 2) . "</td>";
                       echo "<td>R" . number_format($itemSubtotal, 2) . "</td>";
                       echo "</tr>";
                   }

                   echo "</tbody>";
                   echo "</table>";
               } else {
                   echo "<p class='no-items'>No items found for this order.</p>";
               }
           } else {
               // Fallback message if items table doesn't exist
               echo "<p class='info-message'>Order items details not available in current system. Total: R" . number_format($order['total'], 2) . "</p>";
           }
           ?>
       </div>

       <!-- Shipping Information -->
       <div class="shipping-info-section">
           <h2>Shipping Information</h2>
           <div class="info-card">
               <?php
               // Display available shipping information
               $shippingFields = ['shippingAddress', 'city', 'province', 'zipCode', 'phone'];
               $hasShippingInfo = false;

               foreach ($shippingFields as $field) {
                   if (isset($order[$field]) && !empty($order[$field])) {
                       $hasShippingInfo = true;
                       break;
                   }
               }

               if ($hasShippingInfo) {
                   if (!empty($order['shippingAddress'] ?? '')) {
                       echo "<p><strong>Address:</strong> " . htmlspecialchars($order['shippingAddress']) . "</p>";
                   }
                   if (!empty($order['city'] ?? '')) {
                       echo "<p><strong>City:</strong> " . htmlspecialchars($order['city']) . "</p>";
                   }
                   if (!empty($order['province'] ?? '')) {
                       echo "<p><strong>Province:</strong> " . htmlspecialchars($order['province']) . "</p>";
                   }
                   if (!empty($order['zipCode'] ?? '')) {
                       echo "<p><strong>ZIP Code:</strong> " . htmlspecialchars($order['zipCode']) . "</p>";
                   }
                   if (!empty($order['phone'] ?? '')) {
                       echo "<p><strong>Phone:</strong> " . htmlspecialchars($order['phone']) . "</p>";
                   }
               } else {
                   echo "<p class='info-message'>Shipping information not available.</p>";
               }
               ?>
           </div>
       </div>

       <!-- Order Actions -->
       <div class="order-actions-section">
           <?php
           $status = strtolower($order['status']);
           if ($status !== 'cancelled' && $status !== 'completed') {
               echo "<a href='cancel-order.php?orderID=" . htmlspecialchars($orderID) . "' class='action-btn danger-btn' onclick=\"return confirm('Are you sure you want to cancel this order?')\">Cancel Order</a>";
           }
           ?>
           <a href="order-history.php" class="action-btn secondary-btn">Back to Orders</a>
       </div>
   </div>

   <!-- Include footer -->
   <?php include 'includes/footer.php'; ?>

</body>
</html>
