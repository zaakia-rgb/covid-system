<?php
include 'db_connect.php';
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['submit'])){
    $patient_id = $_SESSION['patient_id']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $department = $_POST['department'];
    $hospital = $_POST['hospital'];
    $covid_test = $_POST['covid_test'];
    $vaccination_status = $_POST['vaccination_status'];
    $msg = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO appointment (patient_id, name, email, phone, date, department, hospital, covid_test, vaccination_status, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if($stmt){
        $stmt->bind_param("isssssssss", $patient_id, $name, $email, $phone, $date, $department, $hospital, $covid_test, $vaccination_status, $msg);
        if($stmt->execute()){
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Error: ".$stmt->error."');</script>";
        }
    } else {
        echo "<script>alert('Prepare failed: ".$conn->error."');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Book COVID-19 Appointment</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
/* ===== BODY ===== */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 15px;
}

/* ===== FORM CONTAINER ===== */
.appointment-box {
    background: #ffffff;
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 650px;
    animation: fadeIn 0.7s ease-in-out;
}

/* ===== HEADING ===== */
h2 {
    text-align: center;
    color: #0d6efd;
    font-weight: 700;
    margin-bottom: 40px;
}

/* ===== LABELS ===== */
label {
    font-weight: 600;
    margin-top: 15px;
}

/* ===== FORM ELEMENTS ===== */
input.form-control,
select.form-control,
textarea.form-control {
    border-radius: 12px;
    padding: 14px 16px;
    border: 1.8px solid #ced4da;
    transition: all 0.3s ease;
}

input.form-control:focus,
select.form-control:focus,
textarea.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 12px rgba(13,110,253,0.25);
}

textarea.form-control {
    resize: none;
}

/* ===== BUTTON ===== */
button.btn-warning {
    width: 100%;
    padding: 16px;
    border-radius: 12px;
    font-weight: 600;
    background: linear-gradient(135deg, #fd7e14, #e8590c);
    border: none;
    transition: all 0.3s ease;
    margin-top: 25px;
    font-size: 16px;
}

button.btn-warning:hover {
    background: linear-gradient(135deg, #e8590c, #d9480f);
    transform: translateY(-2px);
}

/* ===== ANIMATION ===== */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* ===== RESPONSIVE ===== */
@media(max-width: 576px){
    .appointment-box {
        padding: 30px 20px;
    }
}
</style>
</head>
<body>

<div class="appointment-box">
    <h2>Book COVID-19 Hospital Appointment</h2>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="John Doe" required>

        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>

        <label>Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="+1 234 567 890" required>

        <label>Date</label>
        <input type="date" name="date" class="form-control" required>

        <label>Department</label>
        <input type="text" name="department" class="form-control" placeholder="e.g., General Medicine">

        <label>Hospital Name</label>
        <input type="text" name="hospital" class="form-control" placeholder="City Hospital" required>

        <label>COVID Test Type</label>
        <select name="covid_test" class="form-control" required>
            <option value="">Select Test Type</option>
            <option value="PCR">PCR</option>
            <option value="Rapid Antigen">Rapid Antigen</option>
            <option value="None">None</option>
        </select>

        <label>Vaccination Status</label>
        <select name="vaccination_status" class="form-control">
            <option value="">Select Status</option>
            <option value="Not Vaccinated">Not Vaccinated</option>
            <option value="Partially Vaccinated">Partially Vaccinated</option>
            <option value="Fully Vaccinated">Fully Vaccinated</option>
        </select>

        <label>Message</label>
        <textarea name="message" class="form-control" rows="3" placeholder="Any additional info..."></textarea>

        <button type="submit" name="submit" class="btn btn-warning">Book Appointment</button>

    </form>
</div>

</body>
</html>
