<?php
include("../config/db.php");
session_start();

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    mysqli_query($conn, "
        UPDATE events SET
        title='$_POST[title]',
        description='$_POST[description]',
        event_date='$_POST[event_date]',
        event_time='$_POST[event_time]',
        venue='$_POST[venue]'
        WHERE id='$id'
    ");
    header("Location: dashboard.php");
}

$event = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM events WHERE id='$id'"));
?>

<form method="POST" class="container mt-5">
    <input name="title" value="<?= $event['title'] ?>" class="form-control mb-2">
    <textarea name="description" class="form-control mb-2"><?= $event['description'] ?></textarea>
    <input type="date" name="event_date" value="<?= $event['event_date'] ?>" class="form-control mb-2">
    <input type="time" name="event_time" value="<?= $event['event_time'] ?>" class="form-control mb-2">
    <input name="venue" value="<?= $event['venue'] ?>" class="form-control mb-2">
    <button class="btn btn-success">Update</button>
</form>
