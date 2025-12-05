<?php
session_start();
include "db.php";

if(!isset($_SESSION['hospital_id'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $result = $_POST['result'];
    $remarks = $_POST['remarks'];

    $stmt = $conn->prepare("UPDATE covid_test_requests SET result=?, remarks=? WHERE id=?");
    $stmt->bind_param("ssi", $result, $remarks, $id);
    $stmt->execute();

    header("Location: covid_requests.php");
    exit;
}

$requests = $conn->query("SELECT * FROM covid_test_requests ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>COVID Test Requests</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f4f9;
            padding: 30px 15px;
        }

        h3 {
            text-align: center;
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .request-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px 25px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }

        .badge {
            font-size: 0.95rem;
            padding: 0.4em 0.8em;
            border-radius: 12px;
        }

        .badge-pending { background-color: #ffc107; color: #212529; }
        .badge-positive { background-color: #dc3545; color: #fff; }
        .badge-negative { background-color: #198754; color: #fff; }

        textarea.form-control {
            resize: none;
        }

        @media(max-width: 576px){
            .request-card { padding: 15px 15px; }
        }
    </style>
</head>
<body>

<h3>COVID Test Requests</h3>

<?php if($requests && $requests->num_rows > 0): ?>
    <?php while($r = $requests->fetch_assoc()): ?>
        <div class="request-card">
            <p><strong>Request #<?php echo $r['id']; ?></strong></p>
            <p><strong>Patient:</strong> <?php echo htmlspecialchars($r['patient_name']); ?></p>
            <p><strong>Symptoms:</strong> <?php echo htmlspecialchars($r['symptoms']); ?></p>
            <p><strong>Hospital:</strong> <?php echo htmlspecialchars($r['hospital_name']); ?></p>
            <p><strong>Result:</strong>
                <?php 
                    if(empty($r['result']) || strtolower($r['result'])=='pending'){
                        echo '<span class="badge badge-pending">Pending</span>';
                    } elseif($r['result']=='Positive'){
                        echo '<span class="badge badge-positive">Positive</span>';
                    } else {
                        echo '<span class="badge badge-negative">Negative</span>';
                    }
                ?>
            </p>
            <p><strong>Remarks:</strong> <?php echo htmlspecialchars($r['remarks'] ?: '-'); ?></p>

            <?php if(empty($r['result']) || strtolower($r['result'])=='pending'): ?>
                <form method="post" class="mt-3">
                    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                    <div class="mb-2">
                        <select name="result" class="form-control" required>
                            <option value="">Select Result</option>
                            <option>Positive</option>
                            <option>Negative</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <textarea name="remarks" class="form-control" placeholder="Enter remarks"></textarea>
                    </div>
                    <button name="update" class="btn btn-success btn-sm">Update Result</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="alert alert-warning text-center">No COVID test requests found.</div>
<?php endif; ?>

<a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>

</body>
</html>
