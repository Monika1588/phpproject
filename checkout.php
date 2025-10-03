<?php
session_start();
$id = $_GET["id"];
$item = null;

// Find the selected item in the cart
foreach ($_SESSION["cart"] as $product) {
    if ($product["id"] == $id) {
        $item = $product;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Green Nursery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Checkout</h2>
    <p><b>Deliver to:</b> <input type="text" class="form-control" placeholder="Enter Address"></p>
    <p><b>Product:</b> <?php echo $item["name"]; ?></p>
    <p><b>Price:</b> $<?php echo number_format($item["price"], 2); ?></p>
    <button class="btn btn-success w-100">Place Order</button>
</div>

</body>
</html>
