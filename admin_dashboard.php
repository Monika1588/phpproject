<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #e3f2fd; }
        .header { background: black; color: white; padding: 15px; text-align: center; }
        .container { margin-top: 30px; }
        .card { transition: transform 0.3s, box-shadow 0.3s; border-radius: 10px; }
        .card:hover { transform: scale(1.05); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); }
        .card i { font-size: 40px; margin-bottom: 10px; }
        .logout-btn { position: absolute; top: 10px; right: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
    </div>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card p-4 text-center bg-primary text-white">
                    <i class="fas fa-box"></i>
                    <h5>Manage Products</h5>
                    <a href="manage_products.php" class="btn btn-light mt-2">Go</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 text-center bg-success text-white">
                    <i class="fas fa-th-large"></i>
                    <h5>Manage Categories</h5>
                    <a href="manage_categories.php" class="btn btn-light mt-2">Go</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 text-center bg-warning text-dark">
                    <i class="fas fa-users"></i>
                    <h5>Manage Users</h5>
                    <a href="manage_users.php" class="btn btn-dark mt-2">Go</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 text-center bg-warning text-dark">
                    <i class="fas fa-users"></i>
                    <h5>Manage Users</h5>
                    <a href="manage_users.php" class="btn btn-dark mt-2">Go</a>
                </div>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
