<?php
session_start();
include '../db_connect.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'hospital'){
    header("Location: ../login.php");
    exit;
}

$hospital_id = $_SESSION['hospital_id'];


if(isset($_POST['add'])){
    $name = $_POST['vaccine_name'];
    $qty = $_POST['quantity'];

    $conn->query("INSERT INTO hospital_vaccines (hospital_id, vaccine_name, quantity) 
                  VALUES ('$hospital_id', '$name', '$qty')");
}


if(isset($_GET['restock'])){
    $id = $_GET['restock'];
    $conn->query("UPDATE hospital_vaccines SET quantity = quantity + 50, status='Available' WHERE id=$id");
    header("Location: vaccine.php");
    exit;
}


if(isset($_GET['finish'])){
    $id = $_GET['finish'];
    $conn->query("UPDATE hospital_vaccines SET quantity = 0, status='Finished' WHERE id=$id");
    header("Location: vaccine.php");
    exit;
}

$vaccines = $conn->query("SELECT * FROM hospital_vaccines WHERE hospital_id=$hospital_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vaccine Management</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2 class="text-center mb-4">Vaccine Management</h2>


<form method="POST" class="mb-4">
    <div class="row">
        <div class="col-md-5">
            <input type="text" name="vaccine_name" class="form-control" placeholder="Vaccine Name" required>
        </div>
        <div class="col-md-5">
            <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
        </div>
        <div class="col-md-2">
            <button name="add" class="btn btn-primary btn-block">Add</button>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Vaccine Name</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $vaccines->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['vaccine_name']; ?></td>
            <td><?= $row['quantity']; ?></td>
            <td>
                <?php if($row['quantity'] == 0): ?>
                    <span class="badge bg-danger">Finished</span>
                <?php else: ?>
                    <span class="badge bg-success">Available</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="vaccine.php?restock=<?= $row['id']; ?>" class="btn btn-sm btn-info">Restock +50</a>
                <a href="vaccine.php?finish=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Finish</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</body>
</html>
