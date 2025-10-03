<?php
$dataFile = "exchanges.json";

$userName = $_POST['userName'] ?? '';
$plantName = $_POST['plantName'] ?? '';
$location = $_POST['location'] ?? '';

if ($userName && $plantName && $location) {
    $newExchange = [
        "userName" => $userName,
        "plantName" => $plantName,
        "location" => $location
    ];

    $exchanges = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
    array_unshift($exchanges, $newExchange);
    file_put_contents($dataFile, json_encode($exchanges, JSON_PRETTY_PRINT));
}
?>
