<?php
include 'db_connect.php';  

if(isset($_POST['submit'])){
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $age   = $_POST['age'];
    $gender = $_POST['gender'];
    $phone  = $_POST['phone'];
    $address = $_POST['address'];

   
    $stmt = $conn->prepare("INSERT INTO signup (name, email, password, age, gender, phone, address) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $name, $email, $pass, $age, $gender, $phone, $address);
    $stmt->execute();

    echo "<script>alert('Signup Successful!'); window.location='login.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Patient Signup</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
        }

        /* ===== SIGNUP FORM CONTAINER ===== */
        .signup-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.6s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 30px;
        }

        label {
            font-weight: 600;
            margin-top: 10px;
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

        button.btn-success {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
            transition: 0.3s;
            margin-top: 20px;
        }

        button.btn-success:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        /* ===== RESPONSIVE ===== */
        @media(max-width: 576px){
            .signup-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="signup-box">
    <h2>Patient Signup</h2>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" class="form-control" required>

        <label>Email</label>
        <input type="email" name="email" class="form-control" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control" required>

        <label>Age</label>
        <input type="number" name="age" class="form-control" required>

        <label>Gender</label>
        <select name="gender" class="form-control">
            <option>Male</option>
            <option>Female</option>
        </select>

        <label>Phone</label>
        <input type="text" name="phone" class="form-control" required>

        <label>Address</label>
        <textarea name="address" class="form-control" rows="3" required></textarea>

        <button type="submit" name="submit" class="btn btn-success">Signup</button>
    </form>
</div>

</body>
</html>
