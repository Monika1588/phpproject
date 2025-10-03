<?php
session_start();
require "includes/db_connect.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $json = file_get_contents("users.json");
    $users = json_decode($json, true);

    foreach ($users as $user) {
        if ($user['username'] === $inputUsername) {
            if (password_verify($inputPassword, $user['password'])) {
                $_SESSION['username'] = $inputUsername;
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === "admin") {
                    header("Location: admin/dashboard.php"); // Admin Redirect
                } else {
                    header("Location: user/index.php"); // User Redirect
                }
                exit();
            }
        }
    }
    echo "❌ Invalid username or password.";
}
?>

<!-- HTML Login Form -->
<form method="POST">
    <input type="text" name="username" placeholder="Enter Username" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Login</button>
</form>
