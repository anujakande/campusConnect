<?php
include("../config/db.php");
session_start();

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM events WHERE id='$id'");

header("Location: dashboard.php");
