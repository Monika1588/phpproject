<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $merchant_transaction_id = $_POST["transactionId"] ?? "UNKNOWN";

    $checksum = hash("sha256", "/pg/v1/status/" . $merchant_transaction_id . PHONEPE_SALT_KEY) . "###" . PHONEPE_SALT_INDEX;

    $ch = curl_init("https://api.phonepe.com/apis/hermes/pg/v1/status/$merchant_transaction_id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json", "X-VERIFY: $checksum"]);

    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);

    if ($response_data["code"] === "PAYMENT_SUCCESS") {
        echo "<h2>Payment Successful!</h2>";
        echo "<p>Transaction ID: " . htmlspecialchars($merchant_transaction_id) . "</p>";
    } else {
        echo "<h2>Payment Failed</h2>";
        echo "<p>Error: " . htmlspecialchars($response_data["message"]) . "</p>";
    }
} else {
    echo "<h2>Invalid Request</h2>";
}
?>
