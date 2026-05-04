<?php
session_start();
include '../includes/DBConn.php';

$id=$_GET['id'];

$conn->query("
DELETE FROM tblUser
WHERE userID=$id
");

header("Location: customers.php");