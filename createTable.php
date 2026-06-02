<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Setup - Create Database Tables</title>
</head>
<body>
    <?php
    include "includes/DBConn.php";

    $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    $conn->query("DROP TABLE IF EXISTS tblOrderItems");
    $conn->query("DROP TABLE IF EXISTS tblAorder");
    $conn->query("DROP TABLE IF EXISTS tblClothes");
    $conn->query("DROP TABLE IF EXISTS tblUser");
    $conn->query("DROP TABLE IF EXISTS tblAdmin");
    $conn->query("SET FOREIGN_KEY_CHECKS = 1");

    $conn->query(
        "CREATE TABLE tblUser (
            userID INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            verified BOOLEAN DEFAULT FALSE,
            profilePicture VARCHAR(255) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )"
    );

    $conn->query(
        "CREATE TABLE tblClothes (
            productID INT AUTO_INCREMENT PRIMARY KEY,
            productCode VARCHAR(30) NOT NULL UNIQUE,
            productName VARCHAR(180) NOT NULL,
            category VARCHAR(30) NOT NULL,
            description TEXT DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL,
            imagePath VARCHAR(255) NOT NULL,
            isActive BOOLEAN DEFAULT TRUE,
            displayOrder INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )"
    );

    $conn->query(
        "CREATE TABLE tblAorder (
            orderID INT AUTO_INCREMENT PRIMARY KEY,
            userID INT NOT NULL,
            total DECIMAL(10,2) NOT NULL,
            status VARCHAR(30) DEFAULT 'Pending',
            orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (userID) REFERENCES tblUser(userID) ON DELETE CASCADE
        )"
    );

    $conn->query(
        "CREATE TABLE tblOrderItems (
            orderItemID INT AUTO_INCREMENT PRIMARY KEY,
            orderID INT NOT NULL,
            productCode VARCHAR(30) NOT NULL,
            productName VARCHAR(180) NOT NULL,
            quantity INT NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (orderID) REFERENCES tblAorder(orderID) ON DELETE CASCADE
        )"
    );

    $conn->query(
        "CREATE TABLE tblAdmin (
            adminID INT AUTO_INCREMENT PRIMARY KEY,
            adminEmail VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )"
    );

    if (($file = fopen("userData.txt", "r")) !== false) {
        while (($line = fgetcsv($file)) !== false) {
            if (count($line) < 3) {
                continue;
            }

            $name = trim($line[0]);
            $email = trim($line[1]);
            $password = trim($line[2]);

            if ($name === "" || $email === "" || $password === "") {
                continue;
            }

            if (!password_get_info($password)['algo']) {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }

            $stmt = $conn->prepare(
                "INSERT INTO tblUser(name, email, password, verified)
                 VALUES (?, ?, ?, 1)"
            );
            $stmt->bind_param("sss", $name, $email, $password);
            $stmt->execute();
        }
        fclose($file);
    }

    $products = [
        ['men1', 'X.S Casual T-Shirt', 'men', 899.00, 'images/men/greyt.jpg', 1],
        ['men3', 'X.S Performance Hoodie', 'men', 699.00, 'images/men/hoodiep.jpg', 2],
        ['men4', 'X.S Casual Hoodie', 'men', 699.00, 'images/men/hoodiew.jpg', 3],
        ['men5', 'X.S Sweater', 'men', 499.00, 'images/men/sweaterf.jpg', 4],
        ['men6', 'X.S Casual T-Shirt', 'men', 599.00, 'images/men/tsm.jpg', 5],

        ['women1', 'X.S Button Dress', 'women', 380.00, 'images/women/1.jpg', 1],
        ['women2', 'X.S Red Long Dress', 'women', 1899.00, 'images/women/2.jpg', 2],
        ['women3', 'X.S Black Long Dress', 'women', 1899.00, 'images/women/3.jpg', 3],
        ['women4', 'X.S Long Sleeve Dress', 'women', 2499.00, 'images/women/4.jpg', 4],
        ['women5', 'X.S Wrap Dress', 'women', 1399.00, 'images/women/5.jpg', 5],
        ['women6', 'X.S Midi Dress', 'women', 699.00, 'images/women/6.jpg', 6],

        ['kids1', 'X.S Black Pants', 'kids', 399.00, 'images/kids/blackpants.jpg', 1],
        ['kids2', 'X.S Essential Tee', 'kids', 300.00, 'images/kids/greyt.jpg', 2],
        ['kids3', 'X.S G-Star Tee', 'kids', 1299.00, 'images/kids/gstar.jpg', 3],
        ['kids4', 'X.S Orange Shirt', 'kids', 300.00, 'images/kids/oranget.jpg', 4],
        ['kids5', 'X.S Polo', 'kids', 699.00, 'images/kids/polo.jpg', 5],
        ['kids6', 'X.S Pullover', 'kids', 1200.00, 'images/kids/pullover.jpg', 6],

        ['new1', 'X.S Kids Dress', 'new', 340.00, 'images/New_Products/n1.jpg', 1],
        ['new2', 'X.S adidas Youth Germany Home World Cup 26 White Stadium Jersey', 'new', 1299.95, 'images/New_Products/adidas_Youth_Germany_Home_World_Cup_26_White_Stadium_Jersey_R1.299.95.png', 2],
        ['new3', 'X.S Anatomy Men\'s Whirl Dragonfly Graphic Brown T-shirt', 'new', 450.00, 'images/New_Products/Anatomy Men\'s Whirl Dragonfly Graphic Brown T-shirt.png', 3],
        ['new4', 'X.S Women\'s Mid Wash Barrel Leg Jeans', 'new', 650.00, 'images/New_Products/Exact Women\'s Mid Wash Barrel Leg Jeans.png', 4],
        ['new5', 'X.S Women\'s White Checked Mesh Dress', 'new', 450.00, 'images/New_Products/Exact Women\'s White Checked Mesh Dress.png', 5],
        ['new6', 'X.S Men\'s Blue King Nap Knitted Flannel Pyjama Set', 'new', 290.00, 'images/New_Products/Jet Men\'s Blue King Nap Knitted Flannel Pyjama Set.png', 6],
        ['new7', 'X.S Women\'s White And Black Stripe Quarter Zip Pullover', 'new', 790.00, 'images/New_Products/pullover.png', 7],
        ['new8', 'X.S Younger Boys Grey Dino Micro Fleece Pyjama Set', 'new', 129.99, 'images/New_Products/Jet Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99.png', 8],
    ];

    $stmt = $conn->prepare(
        "INSERT INTO tblClothes(productCode, productName, category, description, price, imagePath, displayOrder)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    foreach ($products as $product) {
        $description = "";
        $stmt->bind_param(
            "ssssdsi",
            $product[0],
            $product[1],
            $product[2],
            $description,
            $product[3],
            $product[4],
            $product[5]
        );
        $stmt->execute();
    }

    $adminPassword = password_hash("admin123", PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO tblAdmin(adminEmail, password) VALUES (?, ?)");
    $adminEmail = "admin@xclusivesociety.co.za";
    $stmt->bind_param("ss", $adminEmail, $adminPassword);
    $stmt->execute();

    echo "<p>Database tables created and products loaded successfully.</p>";
    echo "<p>Default admin login: admin@xclusivesociety.co.za / admin123</p>";
    ?>
</body>
</html>
