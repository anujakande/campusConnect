<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
}

$clubs = mysqli_query($conn, "SELECT * FROM clubs");

if (isset($_POST['add_event'])) {
    $club_id = $_POST['club_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = $_POST['venue'];

    $query = "INSERT INTO events (club_id, title, description, event_date, event_time, venue)
              VALUES ('$club_id', '$title', '$description', '$event_date', '$event_time', '$venue')";

    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Add Event</h2>

<form method="POST">
    <select class="form-control mb-2" name="club_id" required>
        <option value="">Select Club</option>
        <?php while ($club = mysqli_fetch_assoc($clubs)) { ?>
            <option value="<?= $club['id'] ?>"><?= $club['club_name'] ?></option>
        <?php } ?>
    </select>

    <input class="form-control mb-2" type="text" name="title" placeholder="Event Title" required>
    <textarea class="form-control mb-2" name="description" placeholder="Event Description" required></textarea>
    <input class="form-control mb-2" type="date" name="event_date" required>
    <input class="form-control mb-2" type="time" name="event_time" required>
    <input class="form-control mb-2" type="text" name="venue" placeholder="Venue" required>

    <button class="btn btn-success" name="add_event">Add Event</button>
</form>

<a href="dashboard.php">Back</a>

</body>
</html>
