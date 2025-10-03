<?php
$products = json_decode(file_get_contents('products.json'), true);
echo json_encode($products, JSON_PRETTY_PRINT);
?>
