 <?php
session_start();
include 'includes/db.php'; // Database connection

// Handle Logout (MOVED TO THE TOP TO WORK PROPERLY)
if (isset($_GET['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php");
    exit();
}

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's name and profile image from the database
$sql = "SELECT name, email, profile_image FROM users WHERE id=$user_id";
$result = mysqli_query($connection, $sql);
$user = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
$user_name = $user ? $user['name'] : "User";
$user_email = $user ? $user['email'] : "";
$profile_image = !empty($user['profile_image']) ? $user['profile_image'] : "default.png";

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$user_id";
        mysqli_query($connection, $sql);
        header("Location: home.php");
        exit();
    }

    // Handle Profile Image Upload
    if (isset($_POST['upload_file'])) {
        $file = $_FILES['file'];
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET profile_image='$target_file' WHERE id=$user_id";
            mysqli_query($connection, $sql);
            header("Location: home.php");
            exit();
        }
    }
    // Handle To-Do List Actions
    if (isset($_POST['add_task'])) {
        $task = mysqli_real_escape_string($connection, $_POST['task']);
        $sql = "INSERT INTO tasks (user_id, task, status) VALUES ('$user_id', '$task', 'pending')";
        mysqli_query($connection, $sql);
        header("Location: home.php");
        exit();
    }
    if (isset($_POST['mark_done'])) {
        $task_id = $_POST['task_id'];
        $sql = "UPDATE tasks SET status='done' WHERE id=$task_id";
        mysqli_query($connection, $sql);
        header("Location: home.php");
        exit();
    }
    if (isset($_POST['delete_task'])) {
        $task_id = $_POST['task_id'];
        $sql = "DELETE FROM tasks WHERE id=$task_id";
        mysqli_query($connection, $sql);
        header("Location: home.php");
        exit();
    }
}