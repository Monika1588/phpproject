<?php 
$file = 'topics.json';
$topics = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$id = $_GET['id'] ?? null;
$topic = array_filter($topics, fn($t) => $t['id'] == $id);
$topic = $topic ? array_values($topic)[0] : null;

if (!$topic) {
    die("Topic not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic['title']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2><?php echo $topic['title']; ?></h2>
    <p><?php echo $topic['question']; ?></p>

    <h4>💬 Answers</h4>
    <ul class="list-group">
        <?php 
        if (!empty($topic['answers'])) {
            foreach ($topic['answers'] as $answer) {
                echo '<li class="list-group-item">
                        '.$answer['text'].'
                        <button onclick="likeAnswer(\''.$id.'\', \''.$answer['id'].'\')" class="btn btn-sm btn-light">👍 <span id="likes-'.$answer['id'].'">'.$answer['likes'].'</span></button>
                      </li>';
            }
        } else {
            echo '<p>No answers yet. Be the first to answer!</p>';
        }
        ?>
    </ul>

    <!-- Post an Answer -->
    <form method="POST" action="post_answer.php">
        <input type="hidden" name="topic_id" value="<?php echo $topic['id']; ?>">
        <textarea name="answer" class="form-control mt-3" rows="3" placeholder="Write your answer..." required></textarea>
        <button type="submit" class="btn btn-success mt-2">Post Answer</button>
    </form>
</div>

<script>
function likeAnswer(topicId, answerId) {
    fetch('like_answer.php?topic_id=' + topicId + '&answer_id=' + answerId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('likes-' + answerId).innerText = data.likes;
            }
        });
}
</script>

</body>
</html>
