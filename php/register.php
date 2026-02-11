<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $year       = mysqli_real_escape_string($conn, $_POST['year']);

    // Check email exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered'); window.location.href='../register.html';</script>";
        exit();
    }

    $sql = "INSERT INTO users (name, email, password, department, graduation_year)
            VALUES ('$name', '$email', '$password', '$department', '$year')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful! Please login.'); window.location.href='../login.html';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
