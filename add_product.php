<?php
include "auth.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $products = json_decode(file_get_contents("products.json"), true);

    $new_product = [
        "id" => count($products) + 1,
        "name" => $_POST["name"],
        "price" => "₹" . $_POST["price"]  // <-- Add ₹ here
    ];

    $products[] = $new_product;
    file_put_contents("products.json", json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Product added successfully!";
}
?>

<form method="POST">
    Name: <input type="text" name="name" required><br>
    Price (in ₹): <input type="number" name="price" required><br>
    <input type="submit" value="Add Product">
</form>
