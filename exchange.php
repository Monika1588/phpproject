<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $item = $_POST["item"];
    $exchange_with = $_POST["exchange_with"];

    $data = [
        "user" => $user,
        "item" => $item,
        "exchange_with" => $exchange_with,
        "status" => "Pending"
    ];

    $file = "exchanges.json";
    $exchanges = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    array_unshift($exchanges, $data);
    file_put_contents($file, json_encode($exchanges, JSON_PRETTY_PRINT));

    echo json_encode(["success" => true]);
    exit();
}

$exchanges = file_exists("exchanges.json") ? json_decode(file_get_contents("exchanges.json"), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 Plant Exchange 🌸</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #ffdde1, #ee9ca7);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            text-align: center;
        }
        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2, h3 {
            color: #d63384;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-custom {
            background: #ff6b81;
            color: white;
            border-radius: 20px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #ff4757;
            transform: scale(1.1);
        }
        .alert {
            border-radius: 20px;
            background: rgba(255, 240, 245, 0.8);
            font-weight: bold;
        }
        .notification {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff6b81;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🌸 Plant Exchange 🌸</h2>
        <form id="exchangeForm">
            <input type="text" name="user" class="form-control mb-2" placeholder="Your Name" required>
            <input type="text" name="item" class="form-control mb-2" placeholder="Plant Name" required>
            <input type="text" name="exchange_with" class="form-control mb-2" placeholder="Exchange With" required>
            <button type="submit" class="btn btn-custom w-100">Submit Exchange</button>
        </form>
        <h3 class="mt-4">🌿 Approved Exchanges 🌿</h3>
        <div id="exchangeList" class="mt-3">
            <?php foreach ($exchanges as $exchange) : ?>
                <?php if ($exchange["status"] === "Approved") : ?>
                    <div class="alert alert-success fade-in">
                        🌿 <b><?= htmlspecialchars($exchange["item"]) ?></b> from <b><?= htmlspecialchars($exchange["user"]) ?></b> exchanged with <b><?= htmlspecialchars($exchange["exchange_with"]) ?></b>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="notification" id="notification">Exchange submitted! 🌸</div>
    <script>
        $("#exchangeForm").submit(function(event) {
            event.preventDefault();
            $.post("exchange.php", $(this).serialize(), function(response) {
                let data = JSON.parse(response);
                if (data.success) {
                    $("#notification").fadeIn().delay(2000).fadeOut();
                    setTimeout(() => location.reload(), 2000);
                }
            });
        });
    </script>
</body>
</html>
