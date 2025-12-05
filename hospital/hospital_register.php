<?php
include "db.php";
$msg = "";

if(isset($_POST['register'])){
    $hospital_name = $_POST['hospital_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

 
    $check = $conn->query("SELECT * FROM hospital_login_requests WHERE email='$email'");
    if($check->num_rows > 0){
        $msg = "This email is already registered!";
    } else {
       
        $conn->query("INSERT INTO hospital_login_requests(hospital_name, address, email, phone, status) 
                      VALUES('$hospital_name', '$address', '$email', '$phone', 'pending')");
        $msg = "Request sent! Please wait for admin approval.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Hospital Registration</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<style>
.card {
    max-width: 600px;
    margin: auto;
    padding: 25px;
    margin-top: 40px;
}
</style>
</head>

<body>

<div class="card shadow">
    <h3 class="text-center mb-3">Hospital Registration</h3>

    <?php if($msg){ echo "<div class='alert alert-info'>$msg</div>"; } ?>

    <form method="POST">

        <label>Hospital Name</label>
        <input type="text" name="hospital_name" class="form-control" required>

        <label class="mt-2">Email</label>
        <input type="email" name="email" class="form-control" required>

        <label class="mt-2">Phone</label>
        <input type="text" name="phone" class="form-control" required>

        <label class="mt-2">Address</label>
        <input type="text" name="address" class="form-control" required>

        <button class="btn btn-primary mt-3" name="register">Submit</button>
    </form>
</div>
 <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
