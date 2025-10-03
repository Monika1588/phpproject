<?php
include "auth.php";

$products = json_decode(file_get_contents("products.json"), true);
$id = $_GET["id"];

foreach ($products as $index => $product) {
    if ($product["id"] == $id) {
        $edit_index = $index;
        break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $products[$edit_index]["name"] = $_POST["name"];
    $products[$edit_index]["price"] = $_POST["price"];

    file_put_contents("products.json", json_encode($products, JSON_PRETTY_PRINT));
    echo "Product updated successfully!";
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $products[$edit_index]["name"]; ?>" required><br>
    Price: <input type="number" name="price" value="<?php echo $products[$edit_index]["price"]; ?>" required><br>
    <input type="submit" value="Update Product">
</form>
