<?php
include 'db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Hospitals</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2 class="text-center mb-4">Search Hospitals</h2>

<form method="GET" class="mb-4">
    <div class="mb-3">
        <label>Enter City</label>
        <input type="text" name="city" class="form-control" placeholder="e.g., Karachi" required>
    </div>

    <button type="submit" class="btn btn-info">Search</button>
</form>

<?php
if(isset($_GET['city'])){
    $city = $_GET['city'];

    $stmt = $conn->prepare("SELECT * FROM hospitals WHERE address LIKE ?");
    $searchCity = "%$city%";
    $stmt->bind_param("s", $searchCity);
    $stmt->execute();
    $res = $stmt->get_result();

    echo "<h3 class='mt-4'>Results:</h3>";

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            echo '<div class="card mb-3 shadow-sm">';
            echo '<div class="card-body">';

          
            echo '<h5 class="card-title">'.$row['name'].'</h5>';

            echo '<p class="card-text">
                    <b>Address:</b> '.$row['address'].'<br>
                    <b>Email:</b> '.$row['email'].'<br>
                    <b>Phone:</b> '.$row['phone'].'
                  </p>';

            echo '<a href="appointment.php?hospital='.urlencode($row['name']).'" class="btn btn-primary">Book Appointment</a>';

            echo '</div></div>';
        }
    } else {
        echo '<div class="alert alert-warning">No hospitals found in this city.</div>';
    }
}
?>

</body>
</html>
