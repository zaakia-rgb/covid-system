<?php
session_start();
include "db_connect.php";


if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$data = $conn->query("SELECT * FROM hospital_login_requests WHERE status='pending'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Pending Hospital Requests</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="container mt-4">

<h3>Pending Hospital Requests</h3>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>City</th>
    <th>Action</th>
</tr>

<?php while($r = $data->fetch_assoc()){ ?>
<tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['name'] ?></td>
    <td><?= $r['email'] ?></td>
    <td><?= $r['city'] ?></td>
    <td>
        <a class="btn btn-success btn-sm" href="approve_hospital.php?id=<?= $r['id'] ?>">Approve</a>
        <a class="btn btn-danger btn-sm" href="reject_hospital.php?id=<?= $r['id'] ?>">Reject</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
