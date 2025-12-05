<?php
include 'db_connect.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>COVID Test Status</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        /* ===== GLOBAL STYLES ===== */
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        h2 {
            font-weight: 700;
            color: #0d6efd;
        }

        /* ===== FORM BOX ===== */
        .box {
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            animation: fadeIn 0.6s ease-in-out;
        }

        label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
            padding: 14px;
            border: 1.8px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 12px rgba(13,110,253,0.25);
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #094db3);
        }

        /* ===== RESULT CARDS ===== */
        .result-container {
            width: 100%;
            max-width: 650px;
            margin-top: 30px;
        }

        .result-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0,0,0,0.12);
            margin-bottom: 20px;
            animation: slideUp 0.5s ease-in-out;
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 35px rgba(0,0,0,0.15);
        }

        .result-header {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: #fff;
            padding: 18px 22px;
            font-size: 20px;
            font-weight: 700;
        }

        .result-body {
            padding: 25px 30px;
        }

        .result-body p {
            font-size: 16px;
            margin-bottom: 12px;
        }

        .badge {
            padding: 10px 18px;
            font-size: 16px;
            border-radius: 12px;
        }

        /* ===== ALERT STYLING ===== */
        .alert {
            width: 100%;
            max-width: 650px;
            margin: 20px auto;
            border-radius: 12px;
            font-weight: 500;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes slideUp {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        /* ===== RESPONSIVE ===== */
        @media(max-width: 768px){
            .box, .result-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

<div class="box">
    <h2 class="text-center mb-4">Check COVID Test Status</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label>Enter Email to Check Status</label>
            <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
        </div>
        <button type="submit" class="btn btn-primary">Check Status</button>
    </form>
</div>

<div class="result-container">
<?php
if(isset($_POST['email'])){

    if(!isset($conn)){
        echo "<div class='alert alert-danger'>Database connection failed.</div>";
        exit;
    }

    $email = $_POST['email'];

    $stmt = $conn->prepare("
        SELECT patient_name, phone, request_date, result
        FROM covid_test_requests
        WHERE email = ?
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){

            $badge = 'bg-warning text-dark';
            if($row['result'] == 'Pending') $badge = 'bg-secondary';
            elseif($row['result'] == 'Negative') $badge = 'bg-success';
            elseif($row['result'] == 'Positive') $badge = 'bg-danger';

            echo '
            <div class="result-card">
                <div class="result-header">COVID Test Status</div>
                <div class="result-body">
                    <p><strong>Name:</strong> '.$row['patient_name'].'</p>
                    <p><strong>Phone:</strong> '.$row['phone'].'</p>
                    <p><strong>Test Date:</strong> '.$row['request_date'].'</p>
                    <p><strong>Result:</strong> 
                        <span class="badge '.$badge.'">'.$row['result'].'</span>
                    </p>
                </div>
            </div>';
        }
    } else {
        echo '<div class="alert alert-warning text-center">No COVID test records found for this email.</div>';
    }
}
?>
</div>

</body>
</html>
