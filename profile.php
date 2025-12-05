<?php
include 'db_connect.php';
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];


$query = "SELECT * FROM signup WHERE email='$email'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $patient = mysqli_fetch_assoc($result);
} else {
    echo "<div class='alert alert-danger'>Patient not found!</div>";
    exit;
}


if(isset($_POST['update'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $update_query = "UPDATE signup SET name='$name', phone='$phone', age='$age', gender='$gender', address='$address' WHERE email='$email'";
    if(mysqli_query($conn, $update_query)){
        echo "<div class='alert alert-success'>Profile updated successfully!</div>";
        $result = mysqli_query($conn, $query);
        $patient = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Error updating profile: ".mysqli_error($conn)."</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            padding: 40px 15px;
        }

        h2 {
            text-align: center;
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 30px;
        }

        form {
            background: #fff;
            padding: 40px 30px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
        }

        input.form-control,
        select.form-control,
        textarea.form-control {
            border-radius: 12px;
            padding: 12px 14px;
            border: 1.8px solid #ced4da;
            transition: all 0.3s ease;
        }

        input.form-control:focus,
        select.form-control:focus,
        textarea.form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 12px rgba(13,110,253,0.25);
        }

        textarea.form-control {
            resize: none;
        }

        button.btn-dark {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #343a40, #212529);
            border: none;
            margin-top: 25px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        button.btn-dark:hover {
            background: linear-gradient(135deg, #212529, #121314);
            transform: translateY(-2px);
        }

        @media(max-width: 576px){
            form {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<h2>My Profile</h2>

<form method="POST" action="">
    <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($patient['name']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Email (cannot change)</label>
        <input type="email" class="form-control" value="<?php echo htmlspecialchars($patient['email']); ?>" readonly>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($patient['phone']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="<?php echo htmlspecialchars($patient['age']); ?>">
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <select name="gender" class="form-control">
            <option value="Male" <?php if($patient['gender']=='Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($patient['gender']=='Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if($patient['gender']=='Other') echo 'selected'; ?>>Other</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="3"><?php echo htmlspecialchars($patient['address']); ?></textarea>
    </div>

    <button type="submit" name="update" class="btn btn-dark">Update Profile</button>
</form>

</body>
</html>
