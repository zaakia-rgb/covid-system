<?php
session_start();
include 'db_connect.php';

if (isset($_POST['login'])) {
    $user_input = $_POST['user_input'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $user_input, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $_SESSION['username'] = $user_input;
        $_SESSION['role'] = 'admin';
        header("Location: admin/dashboard.php");
        exit;
    }


    $stmt = $conn->prepare("SELECT * FROM signup WHERE email=? AND password=?");
    $stmt->bind_param("ss", $user_input, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $_SESSION['email'] = $user_input;
        $_SESSION['role'] = 'patient';
        header("Location: index.php");
        exit;
    }

    echo "<script>alert('Invalid username/email or password');</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            background: #e9f7fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-box {
            max-width: 450px;
            margin: 90px auto;
            padding: 35px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #0a97b0;
        }

        label {
            font-weight: 600;
        }

        .btn-primary {
            background: #0a97b0;
            border: none;
            font-size: 18px;
            padding: 10px;
        }

        .btn-primary:hover {
            background: #08788c;
        }

        .footer-link {
            text-align: center;
            margin-top: 15px;
        }

        .footer-link a {
            color: #0a97b0;
            font-weight: bold;
            text-decoration: none;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    <div class="login-box">
        <h2 class="text-center">Login</h2>

        <form method="POST">

            <label>Username (Admin) or Email (Patient)</label>
            <input type="text" name="user_input" class="form-control mb-3" required>

            <label>Password</label>
            <input type="password" name="password" class="form-control mb-4" required>

            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>

        </form>

        <div class="footer-link">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>

</body>

</html>