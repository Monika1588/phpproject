<?php
$dataFile = "exchanges.json";

if (isset($_POST['index'])) {
    $index = (int)$_POST['index'];
    $exchanges = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

    if (isset($exchanges[$index])) {
        array_splice($exchanges, $index, 1);
        file_put_contents($dataFile, json_encode($exchanges, JSON_PRETTY_PRINT));
    }
}
?>
