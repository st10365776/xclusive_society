<?php
include 'admin_auth.php';
require_once '../includes/DBConn.php';
require_once '../includes/schema_helpers.php';
ensureStoreSchema($conn);

$orders = $conn->query("
    SELECT
        o.orderID,
        o.total,
        o.status,
        o.shippingAddress,
        o.shippingMethod,
        o.paymentMethod,
        o.paymentLast4,
        o.orderDate,
        u.name,
        u.email
    FROM tblAorder o
    INNER JOIN tblUser u ON o.userID = u.userID
    ORDER BY o.orderID DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Orders</title>
<style>
body{margin:0;font-family:Arial;background:#121212;color:white;}
.admin-layout{display:flex;min-height:100vh;}
.sidebar{width:220px;background:#1e1e1e;padding:20px;}
.sidebar a{display:block;color:white;padding:12px;text-decoration:none;margin-bottom:10px;border-radius:6px;background:#2a2a2a;}
.sidebar a:hover{background:#ff3c3c;}
.logout{background:#ff3c3c;}
.content{flex:1;padding:40px;}
.card{background:#1e1e1e;padding:20px;border-radius:10px;margin-bottom:24px;}
.order-card{background:#181818;border:1px solid #333;border-radius:8px;padding:18px;margin-bottom:18px;}
.order-head{display:flex;justify-content:space-between;gap:15px;align-items:flex-start;border-bottom:1px solid #333;padding-bottom:12px;margin-bottom:12px;}
.status{background:#2a2a2a;padding:6px 10px;border-radius:5px;}
.muted{color:#aaa;font-size:13px;}
table{width:100%;border-collapse:collapse;margin-top:12px;}
th,td{padding:10px;border-bottom:1px solid #333;text-align:left;}
</style>
</head>
<body>
<div class="admin-layout">
<div class="sidebar">
<h2>Admin Panel</h2>
<a href="dashboard.php">Dashboard</a>
<a href="customers.php">Customers</a>
<a href="products.php">Products</a>
<a href="orders.php">Orders</a>
<a href="seller_submissions.php">Seller Submissions</a>
<a href="admin_messages.php">Notifications</a>
<a href="logout.php" class="logout">Logout</a>
</div>

<div class="content">
<div class="card">
<h1>Orders</h1>

<?php if (!$orders || $orders->num_rows === 0): ?>
<p>No orders yet.</p>
<?php else: ?>
<?php while ($order = $orders->fetch_assoc()): ?>
    <?php
    $itemStmt = $conn->prepare("
        SELECT productName, quantity, price
        FROM tblOrderItems
        WHERE orderID = ?
        ORDER BY orderItemID
    ");
    $itemStmt->bind_param("i", $order['orderID']);
    $itemStmt->execute();
    $items = $itemStmt->get_result();
    ?>

    <div class="order-card" id="order-<?= (int)$order['orderID']; ?>">
        <div class="order-head">
            <div>
                <h2>Order #<?= (int)$order['orderID']; ?></h2>
                <p class="muted"><?= htmlspecialchars($order['name']); ?> - <?= htmlspecialchars($order['email']); ?></p>
                <p class="muted"><?= htmlspecialchars($order['orderDate']); ?></p>
            </div>
            <span class="status"><?= htmlspecialchars($order['status']); ?></span>
        </div>

        <p><strong>Total:</strong> R<?= number_format((float)$order['total'], 2); ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($order['shippingAddress'] ?? 'Not captured'); ?></p>
        <p><strong>Shipping:</strong> <?= htmlspecialchars($order['shippingMethod'] ?? 'Not captured'); ?></p>
        <p><strong>Payment:</strong> <?= htmlspecialchars($order['paymentMethod'] ?? 'Not captured'); ?>
            <?php if (!empty($order['paymentLast4'])): ?>
                ending <?= htmlspecialchars($order['paymentLast4']); ?>
            <?php endif; ?>
        </p>

        <table>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
            <?php while ($item = $items->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($item['productName']); ?></td>
                    <td><?= (int)$item['quantity']; ?></td>
                    <td>R<?= number_format((float)$item['price'], 2); ?></td>
                    <td>R<?= number_format((float)$item['price'] * (int)$item['quantity'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
</div>
</body>
</html>
