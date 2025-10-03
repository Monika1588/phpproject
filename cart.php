<?php
session_start();
$cart = $_SESSION["cart"] ?? [];
$total = 0;
$discount = 0;

foreach ($cart as $item) {
    $total += $item["price"] * $item["quantity"];
}

// Apply a 10% discount if total exceeds ₹50
if ($total > 50) {
    $discount = $total * 0.10;
}
$finalTotal = $total - $discount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Green Nursery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            background: #f4f8f5;
            font-family: 'Arial', sans-serif;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .cart-item:hover {
            transform: scale(1.02);
        }

        .cart-item img {
            width: 100px;
            height: 80px;
            border-radius: 5px;
        }

        .rating {
            color: gold;
            font-size: 18px;
        }

        .btn {
            transition: 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        .cart-summary {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .confetti {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }
    </style>
</head>

<body>

<div class="container mt-4">
    <h2 class="text-center">Your Shopping Cart</h2>

    <div class="row">
        <div class="col-md-8">
            <?php if (empty($cart)): ?>
                <h4 class="text-center mt-5">Your cart is empty!</h4>
            <?php else: ?>
                <?php foreach ($cart as $index => $item): ?>
                    <div class="cart-item">
                        <!-- Product Image -->
                        <img src="<?php echo $item['image']; ?>" width="50">

                        <div>
                            <h5><?php echo htmlspecialchars($item["name"]); ?></h5>
                            <p>Price: <b>₹<?php echo number_format($item["price"], 2); ?></b></p>
                            <p class="rating">⭐⭐⭐⭐⭐ (<?php echo rand(4, 5); ?>/5)</p>

                            <!-- Quantity Dropdown -->
                            <label>Quantity:</label>
                            <select class="quantity-dropdown" data-id="<?php echo $item["id"]; ?>">
                                <?php for ($q = 1; $q <= 10; $q++): ?>
                                    <option value="<?php echo $q; ?>" <?php echo ($q == $item["quantity"]) ? "selected" : ""; ?>><?php echo $q; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div>
                            <button class="btn btn-danger remove-from-cart" data-id="<?php echo $item["id"]; ?>">🗑 Remove</button>
                            <button class="btn btn-success buy-now" data-id="<?php echo $item["id"]; ?>">💳 Buy Now</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Summary -->
        <div class="col-md-4">
            <div class="cart-summary">
                <h4>Order Summary</h4>
                <p>Total: <b>₹<?php echo number_format($total, 2); ?></b></p>
                <p>Discount: <b style="color:green;">-₹<?php echo number_format($discount, 2); ?></b></p>
                <h5>Final Total: <b>₹<?php echo number_format($finalTotal, 2); ?></b></h5>
                <button class="btn btn-primary w-100 mt-3">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</div>

<!-- Confetti Effect -->
<div class="confetti" id="confetti"></div>

<!-- JavaScript -->
<script>
$(".remove-from-cart").click(function () {
    var id = $(this).data("id");
    $.post("remove_from_cart.php", { id: id }, function () {
        location.reload();
    });
});

$(".quantity-dropdown").change(function () {
    var id = $(this).data("id");
    var quantity = $(this).val();
    $.post("update_cart.php", { id: id, quantity: quantity }, function () {
        location.reload();
    });
});

// Buy Now with Confetti Effect
$(".buy-now").click(function () {
    var id = $(this).data("id");
    showConfetti();
    setTimeout(function () {
        window.location.href = "checkout.php?id=" + id;
    }, 2000);
});

// Confetti Animation
function showConfetti() {
    var confetti = document.getElementById("confetti");
    confetti.innerHTML = "";
    for (var i = 0; i < 50; i++) {
        var div = document.createElement("div");
        div.className = "confetti-piece";
        div.style.left = Math.random() * 100 + "vw";
        div.style.animationDuration = Math.random() * 2 + 3 + "s";
        confetti.appendChild(div);
    }
}
</script>

<style>
    .confetti-piece {
        position: absolute;
        width: 8px;
        height: 8px;
        background-color: red;
        animation: fall linear infinite;
    }
    @keyframes fall {
        to {
            transform: translateY(100vh) rotate(360deg);
        }
    }
</style>

</body>
</html>
