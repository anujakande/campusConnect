<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
}

$events = mysqli_query($conn, "SELECT * FROM events");

if (isset($_POST['upload'])) {
    $event_id = $_POST['event_id'];
    $image = $_FILES['image']['name'];
    $target = "../uploads/images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO galleries (event_id, image_path)
                  VALUES ('$event_id', '$image')";
        mysqli_query($conn, $query);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Upload Event Gallery</h2>

<form method="POST" enctype="multipart/form-data">
    <select class="form-control mb-2" name="event_id" required>
        <option value="">Select Event</option>
        <?php while ($event = mysqli_fetch_assoc($events)) { ?>
            <option value="<?= $event['id'] ?>"><?= $event['title'] ?></option>
        <?php } ?>
    </select>

    <input type="file" class="form-control mb-2" name="image" required>
    <button class="btn btn-success" name="upload">Upload</button>
</form>

</body>
</html>
