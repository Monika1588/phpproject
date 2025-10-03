<?php
$dataFile = "exchanges.json";
$exchanges = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

foreach ($exchanges as $index => $exchange) {
    echo "<div class='plant-card p-3 mb-2 border rounded'>";
    echo "🌿 <b>{$exchange['plantName']}</b> from <b>{$exchange['userName']}</b> 📍 {$exchange['location']} ";
    echo "<button class='btn btn-danger btn-sm float-end' onclick='removeExchange($index)'>❌</button>";
    echo "</div>";
}
?>
