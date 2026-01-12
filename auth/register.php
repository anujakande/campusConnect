<?php
include("../config/db.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, role)
              VALUES ('$name', '$email', '$password', 'student')";

    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
    } else {
        $error = "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Student Register</h2>

<form method="POST">
    <input class="form-control mb-2" type="text" name="name" placeholder="Name" required>
    <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
    <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
    <button class="btn btn-primary" name="register">Register</button>
</form>

<?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

</body>
</html>
