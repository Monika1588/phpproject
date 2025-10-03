<?php
include "auth.php";

$products = json_decode(file_get_contents("products.json"), true);
$id = $_GET["id"];

foreach ($products as $index => $product) {
    if ($product["id"] == $id) {
        array_splice($products, $index, 1);
        break;
    }
}

file_put_contents("products.json", json_encode($products, JSON_PRETTY_PRINT));
header("Location: manage_product.php");
exit();
?>
