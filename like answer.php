<?php
session_start();
$file = 'topics.json';

$topic_id = $_GET['topic_id'] ?? null;
$answer_id = $_GET['answer_id'] ?? null;

if ($topic_id && $answer_id) {
    $topics = json_decode(file_get_contents($file), true);

    foreach ($topics as &$topic) {
        if ($topic['id'] == $topic_id) {
            foreach ($topic['answers'] as &$answer) {
                if ($answer['id'] == $answer_id) {
                    $answer['likes'] += 1;
                    file_put_contents($file, json_encode($topics, JSON_PRETTY_PRINT));
                    echo json_encode(['success' => true, 'likes' => $answer['likes']]);
                    exit();
                }
            }
        }
    }
}

echo json_encode(['success' => false]);
?>