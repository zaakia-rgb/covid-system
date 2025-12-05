<?php
session_start();
include 'db_connect.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$where = "";
if(isset($_GET['filter'])){
    $filter = $_GET['filter'];
    if($filter == 'today') $where = "WHERE DATE(request_date) = CURDATE()";
    else if($filter == 'week') $where = "WHERE WEEK(request_date) = WEEK(CURDATE())";
    else if($filter == 'month') $where = "WHERE MONTH(request_date) = MONTH(CURDATE())";
}

if(isset($_POST['export'])){
   
    $export_where = "";
    if(isset($_POST['start_date']) && isset($_POST['end_date']) && $_POST['start_date'] != '' && $_POST['end_date'] != ''){
        $s = $conn->real_escape_string($_POST['start_date']);
        $e = $conn->real_escape_string($_POST['end_date']);
        $export_where = "WHERE request_date BETWEEN '$s 00:00:00' AND '$e 23:59:59'";
    }
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=covid_test_report.xls");
    echo "ID\tPatient Name\tEmail\tPhone\tSymptoms\tHospital Name\tStatus\tRequest Date\tCOVID Result\n";
    $export_query = "SELECT * FROM covid_test_requests $export_where ORDER BY request_date DESC";
    $export_result = $conn->query($export_query);
    if($export_result && $export_result->num_rows > 0){
        while($r = $export_result->fetch_assoc()){
            echo $r['id']."\t".$r['patient_name']."\t".$r['email']."\t".$r['phone']."\t".$r['symptoms']."\t".$r['hospital_name']."\t".$r['request_status']."\t".$r['request_date']."\t".$r['covid_result']."\n";
        }
    }
    exit;
}

$start_date = '';
$end_date = '';
$where2 = '';
if(isset($_POST['filter_range'])){
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    if($start_date != '' && $end_date != ''){
        $where2 = "WHERE request_date BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
    }
}

$result = $conn->query("SELECT * FROM covid_test_requests $where2 $where ORDER BY request_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>COVID Test Requests</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">COVID Test Requests</h2>

    <form method="GET" class="mb-3">
        <select name="filter" class="form-control" style="width:220px; display:inline-block;">
            <option value="">All</option>
            <option value="today" <?= (isset($_GET['filter']) && $_GET['filter']=='today') ? 'selected' : '' ?>>Today</option>
            <option value="week" <?= (isset($_GET['filter']) && $_GET['filter']=='week') ? 'selected' : '' ?>>This Week</option>
            <option value="month" <?= (isset($_GET['filter']) && $_GET['filter']=='month') ? 'selected' : '' ?>>This Month</option>
        </select>
        <button type="submit" class="btn btn-info">Filter</button>
    </form>

    <form method="POST" class="form-inline mb-3">
        <label>From: </label>
        <input type="date" name="start_date" value="<?= htmlspecialchars($start_date); ?>" class="form-control mx-2" required>
        <label>To: </label>
        <input type="date" name="end_date" value="<?= htmlspecialchars($end_date); ?>" class="form-control mx-2" required>
        <button type="submit" name="filter_range" class="btn btn-primary mx-2">Filter Range</button>
        <button type="submit" name="export" class="btn btn-success">Export XLS</button>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr><th>ID</th><th>Patient Name</th><th>Hospital</th><th>Test Date</th><th>Result</th></tr>
        </thead>
        <tbody>
            <?php if($result && $result->num_rows > 0): while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['patient_name']); ?></td>
                <td><?= htmlspecialchars($row['hospital_name']); ?></td>
                <td><?= htmlspecialchars($row['request_date']); ?></td>
                <td><?= htmlspecialchars($row['covid_result']); ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="5" class="text-center">No records found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</body>
</html>
