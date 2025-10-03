<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $users = json_decode(file_get_contents("users.json"), true);
    
    foreach ($users as $user) {
        if ($user["username"] == $_POST["username"] && $user["password"] == $_POST["password"] && $user["role"] == $_POST["role"]) {
            $_SESSION["role"] = $user["role"];
            $_SESSION["username"] = $user["username"];

            if ($user["role"] == "admin") {
                header("Location: dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        }
    }
    echo "<script>alert('Invalid login credentials!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-garden Hub - Login</title>
    <style>
        @keyframes moveBg {
            0% { background-position: 0 0; }
            100% { background-position: 100% 100%; }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            animation: moveBg 10s infinite alternate linear;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 350px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bold;
        }

        input, select {
            width: 85%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            outline: none;
            font-size: 16px;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }

        input:focus, select:focus {
            transform: scale(1.05);
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        }

        .login-btn {
            width: 90%;
            padding: 12px;
            background: linear-gradient(135deg, #16a085, #f4d03f);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
            color: white;
        }

        .register-link a {
            color: #f39c12;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login to E-Garden Hub </h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>

        <select name="role" required>
            <option value="user">Login as User</option>
            <option value="admin">Login as Admin</option>
        </select><br>

        <button type="submit" class="login-btn">Login</button>
    </form>

    <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
