<?php
session_start();

// Load product data from JSON
$products = json_decode(file_get_contents('products.json'), true);

// Get category from URL, with default fallback
$category = isset($_GET['category']) ? $_GET['category'] : 'All';

// Filter products based on category (if not "All")
$filtered_products = ($category === 'All') ? $products : array_filter($products, function ($product) use ($category) {
    return isset($product['category']) && $product['category'] === $category;
});

// If no products found, show message
if (empty($filtered_products)) {
    die("<h2 class='text-center mt-5'>No products found for this category!</h2>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category); ?> - E- Garden Hub</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            background: #f4f9f4;
        }
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .search-bar {
            width: 50%;
            margin: auto;
            display: flex;
            justify-content: center;
        }
        .filter-section {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-seedling"></i> E-Garden Hub</a>
        <a href="cart.php" class="btn btn-warning">View Cart (<span id="cart-count">
            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
        </span>)</a>
    </div>
</nav>

<!-- Search and Filter Section -->
<div class="container mt-4">
    <h2 class="text-center"><?php echo htmlspecialchars($category); ?></h2>
    
    <div class="search-bar mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search Products..." onkeyup="filterProducts()">
    </div>

    <div class="filter-section text-center">
        <label for="priceFilter">Filter by Price:</label>
        <input type="range" id="priceFilter" min="0" max="100" step="5" value="100" oninput="filterProducts()">
        <span id="priceValue">100</span>
    </div>

    <div class="row mt-3" id="productList">
        <?php foreach ($filtered_products as $product): ?>
            <div class="col-md-4 mb-4 product-item" 
                data-name="<?php echo strtolower($product['name']); ?>" 
                data-price="<?php echo $product['price']; ?>">
                
                <div class="card shadow-sm">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top">
                    <div class="card-body text-center">
                        <h5><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="text-muted">₹<?php echo number_format($product['price'], 2); ?></p>

                        <!-- View Details Button -->
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>

                        <!-- Add to Cart Button -->
                        <button class="btn btn-warning add-to-cart" 
                            data-id="<?php echo $product['id']; ?>"
                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                            data-price="<?php echo $product['price']; ?>"
                            data-image="<?php echo htmlspecialchars($product['image']); ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- JavaScript for Search, Filter, and Add to Cart -->
<script>
$(document).ready(function () {
    $(".add-to-cart").click(function () {
        var productData = {
            id: $(this).data("id"),
            name: $(this).data("name"),
            price: $(this).data("price"),
            image: $(this).data("image")
        };

        $.post("add_to_cart.php", productData, function (response) {
            alert(response.message);
            $("#cart-count").text(response.cartCount);
        }, "json");
    });

    $("#priceFilter").on("input", function() {
        $("#priceValue").text($(this).val());
        filterProducts();
    });
});

// Filter function
function filterProducts() {
    let searchQuery = $("#searchInput").val().toLowerCase();
    let priceLimit = $("#priceFilter").val();

    $(".product-item").each(function () {
        let name = $(this).data("name");
        let price = parseFloat($(this).data("price"));

        if (name.includes(searchQuery) && price <= priceLimit) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}
</script>

</body>
</html>
