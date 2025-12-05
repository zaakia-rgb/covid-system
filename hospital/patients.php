<?php
session_start();
include "db.php";

if(!isset($_SESSION['hospital_id'])){
    header("Location: login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM signup ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Patients</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="container mt-4">

<h3>All Patients</h3>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Address</th>
</tr>

<?php while($r = mysqli_fetch_assoc($data)){ ?>
<tr>
    <td><?php echo $r['id'] ?></td>
    <td><?php echo $r['name'] ?></td>
    <td><?php echo $r['email'] ?></td>
    <td><?php echo $r['phone'] ?></td>
    <td><?php echo $r['age'] ?></td>
    <td><?php echo $r['gender'] ?></td>
    <td><?php echo $r['address'] ?></td>
</tr>
<?php } ?>

</table>
 <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
