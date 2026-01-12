<?php
include("../config/db.php");
session_start();

$events = [];
$result = mysqli_query($conn, "SELECT * FROM events");

$today = date("Y-m-d");

while ($row = mysqli_fetch_assoc($result)) {
    $color = ($row['event_date'] < $today) ? "#6c757d" : "#0d6efd"; // past = gray, future = blue

    $events[] = [
        "id" => $row['id'],
        "title" => $row['title'],
        "start" => $row['event_date'],
        "color" => $color
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Calendar</title>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="container mt-5">

<h2 class="text-center">Campus Events Calendar 📅</h2>

<div id="calendar"></div>

<!-- 🔔 EVENT POPUP MODAL -->
<div class="modal fade" id="eventModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="eventTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><b>Club:</b> <span id="eventClub"></span></p>
        <p><b>Description:</b> <span id="eventDescription"></span></p>
        <p><b>Date:</b> <span id="eventDate"></span></p>
        <p><b>Time:</b> <span id="eventTime"></span></p>
        <p><b>Venue:</b> <span id="eventVenue"></span></p>
        <p><b>Registrations:</b> <span id="eventCount"></span></p>
      <div id="eventGallery" class="row mt-3"></div>
      <div class="mt-3 text-end" id="eventActions"></div>
      </div>

    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        events: <?php echo json_encode($events); ?>,

        eventClick: function(info) {
        fetch("get-event.php?id=" + info.event.id)
        .then(res => res.json())
        .then(data => {

            const e = data.event;

            document.getElementById("eventTitle").innerText = e.title;
            document.getElementById("eventClub").innerText = e.club_name;
            document.getElementById("eventDescription").innerText = e.description;
            document.getElementById("eventDate").innerText = e.event_date;
            document.getElementById("eventTime").innerText = e.event_time;
            document.getElementById("eventVenue").innerText = e.venue;
            document.getElementById("eventCount").innerText = data.count;

            // Gallery
            let galleryHTML = "";
            data.images.forEach(img => {
                galleryHTML += `
                    <div class="col-4 mb-2">
                        <img src="../uploads/images/${img}" class="img-fluid rounded">
                    </div>`;
            });
            document.getElementById("eventGallery").innerHTML = galleryHTML;

            // Actions
            let actions = "";
            if (data.role === "admin") {
                actions = `
                    <a href="../admin/edit-event.php?id=${e.id}" class="btn btn-warning">Edit</a>
                    <a href="../admin/delete-event.php?id=${e.id}" class="btn btn-danger">Delete</a>
                `;
            } else if (data.role === "student") {
                const today = new Date().toISOString().split("T")[0];

                if (e.event_date < today) {
                    actions = `<p class="text-danger">Registration closed</p>`;
                } else {
                    actions = `
                        <form method="POST" action="../student/register-event.php">
                            <input type="hidden" name="event_id" value="${e.id}">
                            <button class="btn btn-success w-100">Register</button>
                        </form>
                    `;
                }
            }

            document.getElementById("eventActions").innerHTML = actions;

            new bootstrap.Modal(document.getElementById("eventModal")).show();
        });
    }

    });

    calendar.render();
});
</script>

</body>
</html>
