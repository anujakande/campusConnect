<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Admin Dashboard</h2>

<a href="add-club.php" class="btn btn-primary">Add Club</a>
<a href="add-event.php" class="btn btn-secondary">Add Event</a>
<a href="upload-gallery.php" class="btn btn-info">Upload Event Images</a>
<a href="analytics.php" class="btn btn-dark">View Analytics</a>
<a href="../auth/logout.php" class="btn btn-danger">Logout</a>

</body>
</html>
