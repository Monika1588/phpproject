<?php
// Load product data from JSON
$products = json_decode(file_get_contents('products.json'), true);
$product_id = $_GET['id'] ?? null;

// Find the product by ID
$selected_product = null;
foreach ($products as $product) {
    if ($product['id'] == $product_id) {
        $selected_product = $product;
        break;
    }
}

// Redirect to home if product not found
if (!$selected_product) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selected_product['name']; ?> - Green Nursery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-seedling"></i> Green Nursery</a>
    </div>
</nav>

<!-- Product Details -->
<div class="container mt-5">
    <h2><?php echo $selected_product['name']; ?></h2>
    <img src="<?php echo $selected_product['image']; ?>" class="img-fluid">
    <p><?php echo $selected_product['description']; ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($selected_product['price'], 2); ?></p>
</div>

</body>
</html>
