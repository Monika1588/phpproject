<?php
include "config.php";

$order_id = "ORD" . time(); // Unique order ID
$amount = 50000; // Amount in paisa (₹500 = 50000 paisa)
$callback_url = "http://yourdomain.com/payment_success.php";

// Create payload
$payload = [
    "merchantId" => PHONEPE_MERCHANT_ID,
    "merchantTransactionId" => $order_id,
    "merchantUserId" => "USER123",
    "amount" => $amount,
    "redirectUrl" => $callback_url,
    "redirectMode" => "POST",
    "callbackUrl" => $callback_url,
    "mobileNumber" => "9999999999",
    "paymentInstrument" => [
        "type" => "PAY_PAGE"
    ]
];

// Convert payload to JSON and encrypt
$payload_json = json_encode($payload);
$base64_payload = base64_encode($payload_json);
$checksum = hash("sha256", $base64_payload . PHONEPE_SALT_KEY) . '###' . PHONEPE_SALT_INDEX;

// Prepare API request headers
$headers = [
    "Content-Type: application/json",
    "X-VERIFY: $checksum"
];

// Initiate cURL request
$ch = curl_init(PHONEPE_BASE_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["request" => $base64_payload]));

$response = curl_exec($ch);
curl_close($ch);

// Decode response
$response_data = json_decode($response, true);

// Redirect to PhonePe Payment Page
if (isset($response_data["data"]["instrumentResponse"]["redirectInfo"]["url"])) {
    header("Location: " . $response_data["data"]["instrumentResponse"]["redirectInfo"]["url"]);
    exit();
} else {
    echo "Error: " . $response_data["message"];
}
?>
