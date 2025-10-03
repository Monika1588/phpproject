<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Load exchanges data
$exchangesFile = "exchanges.json";
$exchanges = file_exists($exchangesFile) ? json_decode(file_get_contents($exchangesFile), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $index = $_POST["delete"];
        unset($exchanges[$index]);
        $exchanges = array_values($exchanges); // Re-index array
    } elseif (isset($_POST["approve"])) {
        $index = $_POST["approve"];
        $exchanges[$index]["status"] = "Approved";
    }
    
    file_put_contents($exchangesFile, json_encode($exchanges, JSON_PRETTY_PRINT));
    header("Location: manage_exchanges.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Plant Exchanges</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); font-family: Arial, sans-serif; }
        .container { margin-top: 30px; }
        .table-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .table thead {
            background: linear-gradient(90deg, #ff758c, #ff7eb3);
            color: white;
        }
        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.5);
            transition: 0.3s ease-in-out;
        }
        .btn-custom {
            border: none;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-approve {
            background: #28a745;
            color: white;
        }
        .btn-approve:hover {
            background: #218838;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .filter-container select, .filter-container input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            outline: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center my-4 text-white">🌱 Manage Plant Exchanges</h2>
    <div class="table-container">
        <div class="filter-container">
            <input type="text" id="searchUser" placeholder="Search by Username..." onkeyup="filterTable()">
            <select id="statusFilter" onchange="filterTable()">
                <option value="">Filter by Status</option>
                <option value="Approved">Approved</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <table class="table table-bordered text-center" id="exchangeTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Item Name</th>
                    <th>Exchange With</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($exchanges)): ?>
                    <?php foreach ($exchanges as $index => $exchange): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td class="username"><?= htmlspecialchars($exchange["user"]) ?></td>
                            <td><?= htmlspecialchars($exchange["item"]) ?></td>
                            <td><?= htmlspecialchars($exchange["exchange_with"]) ?></td>
                            <td class="status">
                                <span class="badge bg-<?= $exchange["status"] == "Approved" ? "success" : "warning" ?>">
                                    <?= htmlspecialchars($exchange["status"]) ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <button type="submit" name="approve" value="<?= $index ?>" class="btn btn-custom btn-approve">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button type="submit" name="delete" value="<?= $index ?>" class="btn btn-custom btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No plant exchanges found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterTable() {
    let input = document.getElementById("searchUser").value.toLowerCase().trim();
    let filter = document.getElementById("statusFilter").value.toLowerCase().trim();
    let rows = document.querySelectorAll("#exchangeTable tbody tr");

    rows.forEach(row => {
        let username = row.querySelector(".username").textContent.toLowerCase().trim();
        let status = row.querySelector(".status span").textContent.toLowerCase().trim();

        let matchUsername = username.includes(input) || input === "";
        let matchStatus = (filter === "" || status === filter);

        if (matchUsername && matchStatus) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>