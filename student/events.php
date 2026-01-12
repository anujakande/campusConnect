<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
}

$query = "SELECT events.*, clubs.club_name 
          FROM events 
          JOIN clubs ON events.club_id = clubs.id
          ORDER BY event_date ASC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Upcoming Events</h2>

<?php while ($event = mysqli_fetch_assoc($result)) { ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5><?= $event['title'] ?></h5>
            <p><b>Club:</b> <?= $event['club_name'] ?></p>
            <p><?= $event['description'] ?></p>
            <p><b>Date:</b> <?= $event['event_date'] ?> | <b>Time:</b> <?= $event['event_time'] ?></p>
            <p><b>Venue:</b> <?= $event['venue'] ?></p>

            <form method="POST" action="register-event.php">
                <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                <button class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
<?php } ?>

<a href="dashboard.php">Back</a>

</body>
</html>
