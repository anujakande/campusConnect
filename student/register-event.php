<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];

// Check duplicate
$check = mysqli_query($conn, "
    SELECT * FROM event_registrations
    WHERE user_id='$user_id' AND event_id='$event_id'
");

if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "
        INSERT INTO event_registrations (event_id, user_id)
        VALUES ('$event_id', '$user_id')
    ");
}

header("Location: ../public/calendar.php");
