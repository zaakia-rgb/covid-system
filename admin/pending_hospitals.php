<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$result = $conn->query("SELECT * FROM hospital_login_requests WHERE status='pending' ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pending Hospital Requests</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Pending Hospital Login Requests</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hospital Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result && $result->num_rows): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['hospital_name']); ?></td>
                    <td><?= htmlspecialchars($row['address']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['phone']); ?></td>
                    <td>
                        <a href="approve_hospital.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                        <a href="reject_hospital.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Koi pending request nahin mili</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
