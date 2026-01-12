<?php
include("../config/db.php");
session_start();

$totalEvents = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM events"))['c'];
$totalClubs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM clubs"))['c'];
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM users"))['c'];

$topEvents = mysqli_query($conn, "
    SELECT events.title, COUNT(event_registrations.id) as registrations
    FROM events
    LEFT JOIN event_registrations ON events.id = event_registrations.event_id
    GROUP BY events.id
    ORDER BY registrations DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Admin Analytics 📊</h2>

<div class="row text-center">
    <div class="col-md-4"><div class="card p-3">Total Events<br><b><?= $totalEvents ?></b></div></div>
    <div class="col-md-4"><div class="card p-3">Total Clubs<br><b><?= $totalClubs ?></b></div></div>
    <div class="col-md-4"><div class="card p-3">Total Users<br><b><?= $totalUsers ?></b></div></div>
</div>

<h4 class="mt-4">Top Events</h4>

<table class="table">
<tr><th>Event</th><th>Registrations</th></tr>
<?php while ($row = mysqli_fetch_assoc($topEvents)) { ?>
<tr>
    <td><?= $row['title'] ?></td>
    <td><?= $row['registrations'] ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>
