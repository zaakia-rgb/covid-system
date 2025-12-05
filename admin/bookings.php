<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}


if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM appointment WHERE id = $delete_id");
    echo "<script>alert('Appointment deleted successfully!'); window.location='bookings.php';</script>";
    exit;
}

$result = $conn->query("SELECT * FROM appointment ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Bookings</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Patient Bookings</h2>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Date</th>
                <th>Department</th><th>Phone</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['date']); ?></td>
                <td><?= htmlspecialchars($row['department']); ?></td>
                <td><?= htmlspecialchars($row['phone']); ?></td>

                <td>
                    <a href="bookings.php?delete=<?= $row['id']; ?>"
                       onclick="return confirm('do you want to delete it?');"
                       class="btn btn-danger btn-sm">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
