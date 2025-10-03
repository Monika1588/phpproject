<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $role = "user"; // Default role for new users

    // Read JSON file
    $json_data = file_get_contents("users.json");
    $users = json_decode($json_data, true);

    // Ensure JSON is an array
    if (!is_array($users)) {
        $users = [];
    }

    // Check if username already exists
    foreach ($users as $user) {
        if ($user["username"] === $username) {
            echo "<script>alert('Username already exists! Try another.'); window.location.href='register.php';</script>";
            exit();
        }
    }

    // Add new user to the array
    $users[] = ["username" => $username, "password" => $password, "role" => $role];

    // Save back to JSON file
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));

    echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Nursery</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #a8e063, #56ab2f); /* Green gradient */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        h2 {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .form-group {
            margin: 15px 0;
            position: relative;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
            outline: none;
        }

        input:focus {
            border-color: #2E7D32;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.6);
        }

        button {
            background: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        button::after {
            content: "";
            background: rgba(255, 255, 255, 0.3);
            position: absolute;
            top: 0;
            left: 50%;
            width: 300%;
            height: 100%;
            transform: translateX(-50%) scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease-in-out;
        }

        button:hover {
            background: #388E3C;
        }

        button:hover::after {
            transform: translateX(-50%) scaleX(1);
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            text-decoration: none;
            color: #2E7D32;
            font-weight: bold;
            transition: 0.3s;
        }

        .link a:hover {
            color: #1B5E20;
            text-decoration: underline;
        }

        .plant-icon {
            width: 50px;
            margin-bottom: 10px;
            animation: bounce 2s infinite alternate;
        }

        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-10px); }
        }
    </style>
</head>
<body>

    <div class="container"><br>
        
        <h2>🌱 Register to E-Garden Hub 🌿</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
