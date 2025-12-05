<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$start_date = '';
$end_date = '';
$where = '';

if(isset($_POST['filter'])){
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    if($start_date != '' && $end_date != ''){
        $where = "WHERE (dose1_date BETWEEN '$start_date' AND '$end_date') OR (dose2_date BETWEEN '$start_date' AND '$end_date')";
    }
}

if(isset($_POST['export'])){
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=vaccination_report.xls");
    echo "ID\tPatient ID\tDose1\tDose2\tStatus\n";
    $export_query = "SELECT * FROM vaccination $where ORDER BY id DESC";
    $export_result = $conn->query($export_query);
    if($export_result && $export_result->num_rows){
        while($r = $export_result->fetch_assoc()){
            echo $r['id']."\t".$r['patient_id']."\t".$r['dose1_date']."\t".$r['dose2_date']."\t".$r['status']."\n";
        }
    }
    exit;
}

$result = $conn->query("SELECT * FROM vaccination $where ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vaccination Reports</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Vaccination Reports</h2>

    <form method="POST" class="form-inline mb-3">
        <label>From: </label>
        <input type="date" name="start_date" value="<?= htmlspecialchars($start_date); ?>" class="form-control mx-2" required>
        <label>To: </label>
        <input type="date" name="end_date" value="<?= htmlspecialchars($end_date); ?>" class="form-control mx-2" required>
        <button type="submit" name="filter" class="btn btn-primary mx-2">Filter</button>
        <button type="submit" name="export" class="btn btn-success">Export XLS</button>
    </form>

    <table class="table table-bordered table-striped">
        <thead><tr><th>ID</th><th>Patient ID</th><th>Dose1</th><th>Dose2</th><th>Status</th></tr></thead>
        <tbody>
            <?php if($result && $result->num_rows > 0): while($r = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $r['id']; ?></td>
                <td><?= htmlspecialchars($r['patient_id']); ?></td>
                <td><?= htmlspecialchars($r['dose1_date']); ?></td>
                <td><?= htmlspecialchars($r['dose2_date']); ?></td>
                <td><?= htmlspecialchars($r['status']); ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="5" class="text-center">No records found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
