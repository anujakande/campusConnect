<?php
include("../config/db.php");

$result = mysqli_query($conn, "
    SELECT galleries.image_path, events.title
    FROM galleries
    JOIN events ON galleries.event_id = events.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="text-center">Event Gallery 📸</h2>

<div class="row">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-3 mb-3">
        <div class="card">
            <img src="../uploads/images/<?= $row['image_path'] ?>" class="card-img-top">
            <div class="card-body">
                <p class="card-text text-center"><?= $row['title'] ?></p>
            </div>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
