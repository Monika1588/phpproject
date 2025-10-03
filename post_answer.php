<?php
$file = 'topics.json';

$topic_id = $_POST['topic_id'] ?? null;
$answer_text = trim($_POST['answer'] ?? '');

if ($topic_id && $answer_text) {
    $topics = json_decode(file_get_contents($file), true);

    foreach ($topics as &$topic) {
        if ($topic['id'] == $topic_id) {
            $new_answer = [
                'id' => uniqid(),
                'text' => $answer_text,
                'likes' => 0
            ];
            $topic['answers'][] = $new_answer;
            break;
        }
    }

    file_put_contents($file, json_encode($topics, JSON_PRETTY_PRINT));
    header("Location: discussion.php?id=$topic_id");
    exit();
} else {
    echo "Answer is required!";
}
?>
