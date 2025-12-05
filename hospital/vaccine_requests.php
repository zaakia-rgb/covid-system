<?php
session_start();
include "db.php";

if(!isset($_SESSION['hospital_id'])){
    header("Location: login.php");
    exit;
}


if(isset($_GET['complete'])){
    $id = (int)$_GET['id'];
    mysqli_query($conn, "UPDATE vaccination SET status='Vaccinated', dose1_date = CURDATE() WHERE id=$id");
    header("Location: vaccine_requests.php");
    exit;
}

$data = mysqli_query($conn, "
SELECT 
    s.id AS pid,
    s.name,
    s.email,
    v.id AS vid,
    v.status,
    v.dose1_date
FROM signup s
LEFT JOIN vaccination v ON v.patient_id = s.id
ORDER BY s.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Vaccination Requests</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="container mt-4">

<h3>Vaccination Requests</h3>

<table class="table table-bordered">
<tr>
    <th>Patient ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Dose 1</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($r = mysqli_fetch_assoc($data)){ ?>
<tr>
    <td><?php echo $r['pid'] ?></td>
    <td><?php echo $r['name'] ?></td>
    <td><?php echo $r['email'] ?></td>
    <td><?php echo $r['dose1_date'] ?: "-" ?></td>

    <td>
        <?php echo $r['status'] ?: "Not Vaccinated"; ?>
    </td>

    <td>
        <?php if(empty($r['status']) || $r['status'] != "Vaccinated"){ ?>
            <a class="btn btn-success btn-sm" href="?complete=1&id=<?php echo $r['vid'] ?>">Complete</a>
        <?php } else { echo "Done"; } ?>
    </td>
</tr>
<?php } ?>

</table>
 <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
