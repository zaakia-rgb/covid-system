<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}
$result = $conn->query("SELECT * FROM hospitals ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospitals</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Hospitals</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Address</th><th>Phone</th><th>Email</th></tr>
        </thead>
        <tbody>
            <?php if($result && $result->num_rows): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['address']); ?></td>
                    <td><?= htmlspecialchars($row['phone']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">No hospitals found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
