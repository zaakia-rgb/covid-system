<?php
session_start();
include "db.php";
$msg = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $res = $conn->query("SELECT * FROM hospital_login WHERE email='$email' LIMIT 1");

    if($res->num_rows == 1){
        $row = $res->fetch_assoc();

        if($pass == $row['password']){
            $_SESSION['role'] = 'hospital';
            $_SESSION['hospital_id'] = $row['id'];
            $_SESSION['hospital_name'] = $row['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $msg = "Invalid Password!";
        }
    } else {
        $msg = "No account found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Hospital Login</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="container" style="max-width:600px; margin-top:60px;">

<h3 class="text-center">Hospital Login</h3>

<?php if($msg) echo "<div class='alert alert-danger'>$msg</div>"; ?>

<form method="post">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>

    <label class="mt-2">Password</label>
    <input type="password" name="password" class="form-control" required>

    <button name="login" class="btn btn-primary btn-block mt-3">Login</button>
</form>

<div class="text-center mt-3">
    <a href="hospital_register.php" class="btn btn-success">Register as Hospital</a>
</div>

</body>
</html>
