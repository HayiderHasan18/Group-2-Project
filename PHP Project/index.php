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
//login
  
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (empty($email) || empty($password)) {
        echo "Both fields are required!";
        exit;
    }
    $stmt = $connection->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            echo "Login successful!";
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "User not found.";
    }
    exit;
}
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <!-- Login Form -->
<div id="login" class="form-container">
    <h2>Login</h2>
    <!-- Error message container -->
    <div id="status" style="color: red; font-weight: bold;"></div>
    <form id="login-form">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p class="toggle" onclick="showSection('register')">Don't have an account? Register</p>
</div>
    <!-- Registration Form -->
    <div id="register" class="form-container hidden">
        <h2>Register</h2>
        <form id="register-form">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role_id" required>
                <option value="1">Admin</option>
                <option value="2">User</option>
            </select>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <p class="toggle" onclick="showSection('login')">Already have an account? Login</p>
    </div>

    <script>
        function showSection(sectionId) {
            $(".form-container").addClass("hidden");
            $("#" + sectionId).removeClass("hidden");
        }

        $(document).ready(function () {
    // Registration AJAX
    $("#register-form").on("submit", function (e) {
        e.preventDefault();
        $("#status").html(""); // Clear previous messages
        var formData = $(this).serialize() + "&register=1";
        $.ajax({
            url: "index.php",
            type: "POST",
            data: formData,
            success: function (response) {
                $("#status").html(response); // Display new message
                if (response.includes("successful")) {
                    showSection("login"); // Switch to login form on success
                }
            },
            error: function () {
                $("#status").html("Error occurred. Please try again.");
            }
        });
    });
    });
    </script>
</body>
</html>