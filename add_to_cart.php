<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_POST["image"];

    // Initialize cart if not set
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Check if the item already exists in the cart
    $found = false;
    foreach ($_SESSION["cart"] as &$item) {
        if ($item["id"] == $id) {
            $item["quantity"] += 1;
            $found = true;
            break;
        }
    }

    // If not found, add as new item
    if (!$found) {
        $_SESSION["cart"][] = ["id" => $id, "name" => $name, "price" => $price, "image" => $image, "quantity" => 1];
    }

    // Response for AJAX
    echo json_encode(["message" => "Added to cart!", "cartCount" => count($_SESSION["cart"])]);
}
?>
