<?php
session_start();
include "db.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'hospital'){
    header("Location: login.php");
    exit();
}

$hospital_name = $_SESSION['hospital_name']; 

$appointmentsCount = $conn->query("
    SELECT COUNT(*) AS total FROM appointment
")->fetch_assoc()['total'];

$pendingCovidTests = $conn->query("
    SELECT COUNT(*) AS total 
    FROM covid_test_requests 
    WHERE hospital_name = '$hospital_name'
    AND (result='' OR result IS NULL)
")->fetch_assoc()['total'];

$pendingVaccinations = $conn->query("
    SELECT COUNT(*) AS total 
    FROM vaccination 
    WHERE status='Not Vaccinated'
")->fetch_assoc()['total'];

$patientsCount = $conn->query("
    SELECT COUNT(*) AS total FROM signup
")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <style>
        .card-box {
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 25px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            transition: 0.3s;
            min-height: 150px;
        }
        .card-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }
        .icon {
            font-size: 45px;
            margin-bottom: 15px;
            color: #0aa6d4;
        }
    </style>
</head>

<body class="container mt-5">

<h2 class="text-center mb-4">Hospital Dashboard</h2>

<div class="row">

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-calendar icon"></i>
            <h4>Total Appointments</h4>
            <h3><?php echo $appointmentsCount; ?></h3>
            <a href="appointments.php" class="btn btn-primary btn-block mt-2">View Appointments</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-flask icon"></i>
            <h4>Pending COVID Tests</h4>
            <h3><?php echo $pendingCovidTests; ?></h3>
            <a href="covid_requests.php" class="btn btn-warning btn-block mt-2">Manage Tests</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-medkit icon"></i>
            <h4>Pending Vaccinations</h4>
            <h3><?php echo $pendingVaccinations; ?></h3>
            <a href="vaccine_requests.php" class="btn btn-success btn-block mt-2">Manage Vaccinations</a>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-users icon"></i>
            <h4>Total Patients</h4>
            <h3><?php echo $patientsCount; ?></h3>
            <a href="patients.php" class="btn btn-info btn-block mt-2">View Patients</a>
        </div>
    </div>

    
    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-medkit icon"></i>
            <h4>Vaccine Management</h4>
            <h3>Manage</h3>
            <a href="vaccine.php" class="btn btn-success btn-block mt-2">Manage Vaccines</a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card-box">
            <i class="fa fa-sign-out icon"></i>
            <h4>Logout</h4>
            <a href="logout.php" class="btn btn-danger btn-block mt-2">Logout</a>
        </div>
    </div>

</div>

</body>
</html>
