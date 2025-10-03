<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$file = "exchanges.json";
$exchanges = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["approve"])) {
        $index = $_POST["approve"];
        $exchanges[$index]["approved"] = true;
    } elseif (isset($_POST["delete"])) {
        $index = $_POST["delete"];
        array_splice($exchanges, $index, 1);
    }
    file_put_contents($file, json_encode($exchanges, JSON_PRETTY_PRINT));
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Dashboard</h2>
        <a href="logout.php" class="btn btn-danger float-end">Logout</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Plant</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exchanges as $index => $exchange) : ?>
                    <tr>
                        <td><?= $exchange["userName"] ?></td>
                        <td><?= $exchange["plantName"] ?></td>
                        <td><?= $exchange["location"] ?></td>
                        <td>
                            <?php if (!$exchange["approved"]) : ?>
                                <form method="post" style="display:inline;">
                                    <button type="submit" name="approve" value="<?= $index ?>" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            <?php endif; ?>
                            <form method="post" style="display:inline;">
                                <button type="submit" name="delete" value="<?= $index ?>" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
