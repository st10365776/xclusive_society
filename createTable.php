<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
include "DBConn.php";

/* delete table if exists */
$conn->query("DROP TABLE IF EXISTS tblUser");

/* recreate table */
$sql = "CREATE TABLE tblUser (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150),
    password VARCHAR(255),
    verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($sql);

/* load text file data */
$file = fopen("userData.txt","r");

while(($line = fgetcsv($file)) !== FALSE){

    $name = $line[0];
    $email = $line[1];
    $password = $line[2];

    $stmt = $conn->prepare(
        "INSERT INTO tblUser(name,email,password)
         VALUES (?,?,?)"
    );

    $stmt->bind_param("sss",$name,$email,$password);
    $stmt->execute();
}

fclose($file);

echo "tblUser recreated and data loaded!";
?>
</body>
</html>