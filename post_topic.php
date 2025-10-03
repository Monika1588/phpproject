<?php
$file = 'topics.json';

$title = trim($_POST['title'] ?? '');
$question = trim($_POST['question'] ?? '');

if ($title && $question) {
    $topics = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    if (!is_array($topics)) {
        $topics = [];
    }

    $new_topic = [
        'id' => uniqid(),
        'title' => $title,
        'question' => $question,
        'answers' => []
    ];

    $topics[] = $new_topic;
    file_put_contents($file, json_encode($topics, JSON_PRETTY_PRINT));
    header("Location: forum.php");
    exit();
} else {
    echo "Title and question are required!";
}
?>
