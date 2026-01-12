<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard | CampusConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h2 class="mb-3">Welcome to CampusConnect 🎓</h2>
            <p class="text-muted">Explore upcoming campus events and register easily</p>

            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <a href="events.php" class="btn btn-primary btn-lg">
                    View Upcoming Events
                </a>

                <a href="../public/calendar.php" class="btn btn-outline-secondary btn-lg">
                    View Event Calendar
                </a>

                <a href="../auth/logout.php" class="btn btn-danger btn-lg">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
