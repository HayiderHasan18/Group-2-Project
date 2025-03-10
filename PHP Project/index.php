<?php
session_start();
include 'includes/db.php'; // Database connection
// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registration
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role_id = $_POST['role_id'];
        $gender = $_POST['gender'];

        $sql = "INSERT INTO users (name, email, password, role_id, gender) VALUES ('$name', '$email', '$password', '$role_id', '$gender')";
        if (mysqli_query($connection, $sql)) {
            echo "Registration successful! Please login.";
        } else {
            echo "Error: Registration failed.";
        }
    }