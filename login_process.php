<?php
session_start();

// Read JSON file
$json_data = file_get_contents("users.json");
$users = json_decode($json_data, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Check if JSON is correctly loaded
    if (!$users || !is_array($users)) {
        die("Error loading user data.");
    }

    // Validate user credentials
    foreach ($users as $user) {
        if ($user["username"] === $username && $user["password"] === $password) {
            $_SESSION["user"] = $username;
            $_SESSION["role"] = $user["role"];

            // Redirect based on role
            if ($user["role"] === "admin") {
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
            exit();
        }
    }

    // If login fails
    echo "<script>alert('Invalid username or password! Try again.'); window.location.href='login.php';</script>";
}
?>
