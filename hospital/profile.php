<?php
session_start();
include "db.php";

if(!isset($_SESSION['hospital_id'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['hospital_id'];

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $loc = $_POST['location'];

    mysqli_query($conn, "UPDATE hospital_login SET name='$name' WHERE id=$id");

    $_SESSION['hospital_name'] = $name;
}

$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hospital_login WHERE id=$id"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="container mt-4">

<h3>Hospital Profile</h3>

<form method="post">
<label>Name</label>
<input type="text" class="form-control" name="name" value="<?php echo $info['name'] ?>">

<label class="mt-2">Location</label>
<input type="text" class="form-control" name="location">

<button class="btn btn-primary mt-3" name="save">Save</button>
</form>
 <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
