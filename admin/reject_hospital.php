<?php
include 'db_connect.php';

$id = $_GET['id'];

$conn->query("UPDATE hospital_login_requests SET status='rejected' WHERE id=$id");

echo "<script>alert('Request Rejected'); window.location='hospital_requests.php';</script>";
?>
