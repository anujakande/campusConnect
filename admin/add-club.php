<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
}

if (isset($_POST['add_club'])) {
    $club_name = $_POST['club_name'];
    $description = $_POST['description'];

    $query = "INSERT INTO clubs (club_name, description)
              VALUES ('$club_name', '$description')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Add Club</h2>

<form method="POST">
    <input class="form-control mb-2" type="text" name="club_name" placeholder="Club Name" required>
    <textarea class="form-control mb-2" name="description" placeholder="Club Description" required></textarea>
    <button class="btn btn-primary" name="add_club">Add Club</button>
</form>

<a href="dashboard.php">Back</a>

</body>
</html>
