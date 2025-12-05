<?php
include 'db_connect.php';
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];

$patient_query = "SELECT id, name, phone FROM signup WHERE email='$email'";
$patient_result = mysqli_query($conn, $patient_query);

if(mysqli_num_rows($patient_result) > 0){
    $patient = mysqli_fetch_assoc($patient_result);
    $name = $patient['name'];
    $phone = $patient['phone'];

    $test_query = "SELECT patient_name, symptoms, hospital_name, result, remarks, result_file, id 
                   FROM covid_test_requests 
                   WHERE email='$email' 
                   ORDER BY id DESC";
    $test_result = mysqli_query($conn, $test_query);

    $vac_query = "SELECT dose1_date, dose2_date, status FROM vaccination WHERE patient_id='".$patient['id']."'";
    $vac_result = mysqli_query($conn, $vac_query);
} else {
    echo "<div class='alert alert-danger'>Patient not found!</div>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>COVID Test & Vaccination Results</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            color: #0d6efd;
            font-weight: 700;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #495057;
            margin-top: 30px;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: #0d6efd;
            bottom: -5px;
            left: 0;
            border-radius: 2px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .card-body p {
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .badge {
            font-size: 0.95rem;
            padding: 0.4em 0.8em;
            border-radius: 12px;
        }

        .bg-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .bg-negative {
            background-color: #198754;
            color: #fff;
        }

        .bg-positive {
            background-color: #dc3545;
            color: #fff;
        }

        a {
            color: #0d6efd;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 900px;
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">My COVID Test & Vaccination Results</h2>

    <div class="patient-info">
        <h4 class="section-title">Patient Info</h4>
        <div class="card p-3 mb-4">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
        </div>
    </div>

    <div class="covid-tests">
        <h4 class="section-title">COVID Test Results</h4>
        <?php
        if(mysqli_num_rows($test_result) > 0){
            while($row = mysqli_fetch_assoc($test_result)){
                $badge_class = 'bg-pending';
                $result_text = $row['result'] ?: 'Pending';

                if($row['result'] === 'Negative') $badge_class = 'bg-negative';
                elseif($row['result'] === 'Positive') $badge_class = 'bg-positive';

                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo "<p><strong>Request ID:</strong> {$row['id']}</p>";
                echo "<p><strong>Hospital:</strong> ".htmlspecialchars($row['hospital_name'])."</p>";
                echo "<p><strong>Symptoms:</strong> ".htmlspecialchars($row['symptoms'])."</p>";
                echo "<p><strong>Result:</strong> <span class='badge $badge_class'>$result_text</span></p>";
                echo "<p><strong>Remarks:</strong> ".($row['remarks'] ?: '-')."</p>";
                if(!empty($row['result_file'])){
                    echo "<p><strong>File:</strong> <a href='uploads/".htmlspecialchars($row['result_file'])."' target='_blank'>View</a></p>";
                }
                echo '</div></div>';
            }
        } else {
            echo '<div class="alert alert-warning">No COVID test requests found.</div>';
        }
        ?>
    </div>

    <div class="vaccination">
        <h4 class="section-title">Vaccination Status</h4>
        <?php
        if(mysqli_num_rows($vac_result) > 0){
            $vac = mysqli_fetch_assoc($vac_result);
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo "<p><strong>Dose 1:</strong> ".($vac['dose1_date'] ?: '-')."</p>";
            echo "<p><strong>Dose 2:</strong> ".($vac['dose2_date'] ?: '-')."</p>";
            echo "<p><strong>Status:</strong> ".($vac['status'] ?: '-')."</p>";
            echo '</div></div>';
        } else {
            echo '<div class="alert alert-warning">No vaccination records found.</div>';
        }
        ?>
    </div>
</div>

</body>
</html>
