<?php
include "auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #e3f2fd; }
        .header { background: #2e7d32; color: white; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; }
        .container { margin-top: 30px; }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            border: none;
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .card i {
            font-size: 50px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">Manage Products</div>
    
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <a href="manage_plants.php" class="text-decoration-none">
                    <div class="card bg-success text-white">
                        <i class="fas fa-seedling"></i>
                        <h5>Manage Plants</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="manage_seeds.php" class="text-decoration-none">
                    <div class="card bg-warning text-dark">
                        <i class="fas fa-seedling"></i>
                        <h5>Manage Seeds</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="manage_tools.php" class="text-decoration-none">
                    <div class="card bg-info text-dark">
                        <i class="fas fa-tools"></i>
                        <h5>Manage Tools</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="manage_pots.php" class="text-decoration-none">
                    <div class="card bg-danger text-white">
                        <i class="fas fa-vase"></i>
                        <h5>Manage Pots</h5>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="manage_fertilizers.php" class="text-decoration-none">
                    <div class="card bg-primary text-white">
                        <i class="fas fa-leaf"></i>
                        <h5>Manage Fertilizers</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>



