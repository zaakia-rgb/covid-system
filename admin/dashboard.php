<?php
session_start();
include '../db_connect.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}


$patientsCount = $conn->query("SELECT COUNT(*) as total FROM signup")->fetch_assoc()['total'];
$hospitalsCount = $conn->query("SELECT COUNT(*) as total FROM hospitals")->fetch_assoc()['total'];
$pendingHospitals = $conn->query("SELECT COUNT(*) as total FROM hospital_login_requests WHERE status='pending'")->fetch_assoc()['total'];
$bookingsCount = $conn->query("SELECT COUNT(*) as total FROM appointment")->fetch_assoc()['total'];
$covidRequests = $conn->query("SELECT COUNT(*) as total FROM covid_test_requests")->fetch_assoc()['total'];
$vaccineRecords = $conn->query("SELECT COUNT(*) as total FROM vaccination")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <style>
        .card-box { padding:25px; background:#fff; border-radius:12px; text-align:center; margin-bottom:25px; box-shadow:0 0 15px rgba(0,0,0,0.08); transition:0.3s; min-height:150px; }
        .card-box:hover { transform:translateY(-6px); box-shadow:0 0 20px rgba(0,0,0,0.15); }
        .icon { font-size:45px; margin-bottom:15px; color:#0aa6d4; }
    </style>
</head>
<body class="container mt-5">
<h2 class="text-center mb-4">Admin Dashboard</h2>

<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-users icon"></i>
            <h4>Total Patients</h4>
            <h3><?= $patientsCount; ?></h3>
            <a href="patients.php" class="btn btn-primary btn-block mt-2">View Patients</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-hospital-o icon"></i>
            <h4>Total Hospitals</h4>
            <h3><?= $hospitalsCount; ?></h3>
            <a href="hospitals.php" class="btn btn-success btn-block mt-2">View Hospitals</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-user-plus icon"></i>
            <h4>Pending Hospital Requests</h4>
            <h3><?= $pendingHospitals; ?></h3>
            
            <a href="pending_hospitals.php" class="btn btn-warning btn-block mt-2">View Pending</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-calendar icon"></i>
            <h4>Total Bookings</h4>
            <h3><?= $bookingsCount; ?></h3>
            <a href="bookings.php" class="btn btn-info btn-block mt-2">View Bookings</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-flask icon"></i>
            <h4>COVID Test Requests</h4>
            <h3><?= $covidRequests; ?></h3>
            <a href="covid_test_requests.php" class="btn btn-danger btn-block mt-2">View Requests</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-medkit icon"></i>
            <h4>Vaccination Records</h4>
            <h3><?= $vaccineRecords; ?></h3>
            <a href="vaccination_reports.php" class="btn btn-primary btn-block mt-2">View Records</a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card-box">
            <i class="fa fa-sign-out icon"></i>
            <h4>Logout</h4>
            <a href="logout.php" class="btn btn-danger btn-block mt-2">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
