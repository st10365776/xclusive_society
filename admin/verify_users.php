<?php
session_start();
include '../includes/DBConn.php';

$id=$_GET['id'];

$conn->query("
UPDATE tblUser
SET verified=1
WHERE userID=$id
");

header("Location: customers.php");