<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}
$result = $conn->query("SELECT v.*, s.name as patient_name, s.email as patient_email FROM vaccination v LEFT JOIN signup s ON v.patient_id = s.id ORDER BY v.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vaccination Records</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Vaccination Records</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr><th>ID</th><th>Patient</th><th>Dose 1 Date</th><th>Dose 2 Date</th><th>Status</th></tr>
        </thead>
        <tbody>
            <?php if($result && $result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars(($row['patient_name'] ? $row['patient_name'] : 'Patient ID: '.$row['patient_id'])); ?></td>
                <td><?= htmlspecialchars($row['dose1_date']); ?></td>
                <td><?= htmlspecialchars($row['dose2_date']); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="5" class="text-center">No vaccination records</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
