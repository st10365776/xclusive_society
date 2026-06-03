<?php
session_start();
include '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $stmt = $conn->prepare("
        DELETE FROM tblSellerSubmissions
        WHERE submissionID = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: seller_submissions.php");
exit();
?>