<?php
include "auth.php";

$products = json_decode(file_get_contents("products.json"), true);

// Debug: Check if products are loaded
if ($products === null) {
    die("Error loading products.json");
}

// Filter products to show only Gardening Tools
$tools = array_filter($products, function ($product) {
    return isset($product['category']) && strtolower(trim($product['category'])) === 'gardening tools';
});

// Debug: Check if tools are being filtered correctly
if (empty($tools)) {
    echo "<p class='text-center text-danger'>No tools found in the database.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tools - Nursery E-Commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: #e3f2fd;
            font-family: 'Arial', sans-serif;
        }
        .header {
            background: #2e7d32; 
            color: white; 
            padding: 15px; 
            text-align: center;
            position: relative;
            font-size: 24px;
            font-weight: bold;
        }
        .container { margin-top: 30px; }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            border: none;
            overflow: hidden;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
        }
        .product-price {
            font-size: 16px;
            color: #388e3c;
            font-weight: bold;
        }
        .action-btns a {
            margin: 5px;
            text-decoration: none;
        }
        .btn-add {
            display: block;
            width: fit-content;
            margin: 20px auto;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        Manage Tools
        <a href="logout.php" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-3">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
    
    <div class="container">
        <a href="add_product.php" class="btn btn-success btn-add">
            <i class="fas fa-plus"></i> Add New Tool
        </a>
        
        <div class="row g-4">
            <?php if (!empty($tools)) { ?>
                <?php foreach ($tools as $tool) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($tool['image']); ?>" class="card-img-top" alt="Tool Image">
                            <div class="card-body text-center">
                                <p class="product-name"><?php echo htmlspecialchars($tool['name']); ?></p>
                                <p class="product-price">₹<?php echo htmlspecialchars($tool['price']); ?></p>
                                <div class="action-btns">
                                    <a href="edit_product.php?id=<?php echo $tool['id']; ?>" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="delete_product.php?id=<?php echo $tool['id']; ?>" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="text-center text-danger">No tools available.</p>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
