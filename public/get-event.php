<?php
include("../config/db.php");
session_start();

$event_id = $_GET['id'];

$eventQuery = "
    SELECT events.*, clubs.club_name
    FROM events
    JOIN clubs ON events.club_id = clubs.id
    WHERE events.id = '$event_id'
";

$event = mysqli_fetch_assoc(mysqli_query($conn, $eventQuery));

$galleryQuery = "SELECT image_path FROM galleries WHERE event_id='$event_id'";
$galleryResult = mysqli_query($conn, $galleryQuery);

$images = [];
while ($img = mysqli_fetch_assoc($galleryResult)) {
    $images[] = $img['image_path'];
}

$countQuery = mysqli_query($conn, "
    SELECT COUNT(*) as total FROM event_registrations
    WHERE event_id='$event_id'
");

$count = mysqli_fetch_assoc($countQuery)['total'];

echo json_encode([
    "event" => $event,
    "images" => $images,
    "count" => $count,
    "role" => $_SESSION['role'] ?? null
]);

