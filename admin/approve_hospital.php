<?php
include "db_connect.php";

$id = $_GET['id'];

$q = $conn->query("SELECT * FROM hospital_login_requests WHERE id=$id");
$data = $q->fetch_assoc();

$hospital_name = $data['hospital_name'];
$email = $data['email'];
$phone = $data['phone'];

$password = substr($phone, -4);

$conn->query("INSERT INTO hospital_login(name, email, password)
              VALUES('$hospital_name', '$email', '$password')");

$conn->query("UPDATE hospital_login_requests SET status='approved' WHERE id=$id");

echo "<script>alert('Hospital Approved! Default Password: $password'); 
window.location='hospital_requests.php';</script>";
?>
