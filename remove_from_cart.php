<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    foreach ($_SESSION["cart"] as $index => $item) {
        if ($item["id"] == $id) {
            unset($_SESSION["cart"][$index]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]);
            break;
        }
    }
    echo json_encode(["message" => "Item removed!", "cartCount" => count($_SESSION["cart"])]);
}
?>
