<?php
include 'db_connect.php';
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $symptoms = $_POST['symptoms'];
    $hospital = $_POST['hospital'];

    $stmt = $conn->prepare("INSERT INTO covid_test_requests (patient_name, email, phone, symptoms, hospital_name) VALUES (?, ?, ?, ?, ?)");
    
    if($stmt){
        $stmt->bind_param("sssss", $name, $email, $phone, $symptoms, $hospital);
        if($stmt->execute()){
            echo "<script>alert('COVID-19 test request submitted successfully!'); window.location='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error: ".$stmt->error."'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Prepare failed: ".$conn->error."'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>COVID Test Request</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
/* ===== BODY ===== */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 15px;
}

/* ===== FORM CONTAINER ===== */
.request-box {
    background: #fff;
    padding: 45px 35px;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 600px;
    animation: fadeIn 0.7s ease-in-out;
    margin-top: 30px;
}

/* ===== HEADING ===== */
h2 {
    text-align: center;
    color: #dc3545;
    font-weight: 700;
    margin-bottom: 35px;
}

/* ===== LABELS ===== */
label {
    font-weight: 600;
    margin-top: 15px;
}

/* ===== FORM ELEMENTS ===== */
input.form-control,
textarea.form-control {
    border-radius: 12px;
    padding: 12px 16px;
    border: 1.8px solid #ced4da;
    transition: all 0.3s ease;
}

input.form-control:focus,
textarea.form-control:focus {
    border-color: #dc3545;
    box-shadow: 0 0 12px rgba(220,53,69,0.25);
}

textarea.form-control {
    resize: none;
}

/* ===== BUTTON ===== */
button.btn-danger {
    width: 100%;
    padding: 16px;
    border-radius: 12px;
    font-weight: 600;
    background: linear-gradient(135deg, #dc3545, #c82333);
    border: none;
    transition: all 0.3s ease;
    margin-top: 25px;
    font-size: 16px;
}

button.btn-danger:hover {
    background: linear-gradient(135deg, #c82333, #bd2130);
    transform: translateY(-2px);
}

/* ===== ANIMATION ===== */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* ===== RESPONSIVE ===== */
@media(max-width: 576px){
    .request-box {
        padding: 30px 20px;
    }
}
</style>
</head>
<body>

<div class="request-box">
    <h2>Request COVID-19 Test</h2>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="John Doe" required>

        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>

        <label>Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="+1 234 567 890" required>

        <label>Symptoms</label>
        <textarea name="symptoms" class="form-control" rows="3" placeholder="Describe your symptoms..." required></textarea>

        <label>Hospital (Optional)</label>
        <input type="text" name="hospital" class="form-control" placeholder="City Hospital">

        <button type="submit" class="btn btn-danger">Submit Request</button>
    </form>
</div>

</body>
</html>
