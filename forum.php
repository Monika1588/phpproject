<?php 
session_start();

$discussionFile = 'discussion.json';
$showcaseFile = 'showcase.json';

// Load existing data
$discussions = file_exists($discussionFile) ? json_decode(file_get_contents($discussionFile), true) : [];
$showcase = file_exists($showcaseFile) ? json_decode(file_get_contents($showcaseFile), true) : [];

// Handle new discussion post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
    $question = trim($_POST['question']);
    if (!empty($question)) {
        $discussions[] = [
            'id' => uniqid(),
            'question' => $question,
            'answers' => [],
        ];
        file_put_contents($discussionFile, json_encode($discussions, JSON_PRETTY_PRINT));
    }
    header("Location: forum.php");
    exit();
}

// Handle new answer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'], $_POST['question_id'])) {
    $answer = trim($_POST['answer']);
    $question_id = $_POST['question_id'];

    foreach ($discussions as &$discussion) {
        if ($discussion['id'] === $question_id) {
            $discussion['answers'][] = [
                'id' => uniqid(),
                'text' => $answer,
                'likes' => 0
            ];
        }
    }

    file_put_contents($discussionFile, json_encode($discussions, JSON_PRETTY_PRINT));
    header("Location: forum.php");
    exit();
}

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadsDir = "uploads/";
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $name = trim($_POST['name'] ?? 'Anonymous');
    $address = trim($_POST['address'] ?? 'Unknown Location');
    $imageName = time() . "_" . basename($_FILES['image']['name']);
    $imagePath = $uploadsDir . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $showcase[] = [
            'id' => uniqid(),
            'name' => $name,
            'address' => $address,
            'image' => $imagePath,
            'likes' => 0
        ];
        file_put_contents($showcaseFile, json_encode($showcase, JSON_PRETTY_PRINT));
    }

    header("Location: forum.php");
    exit();
}

// Handle like button for showcase
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like_id'])) {
    foreach ($showcase as &$entry) {
        if ($entry['id'] === $_POST['like_id']) {
            $entry['likes']++;
        }
    }
    file_put_contents($showcaseFile, json_encode($showcase, JSON_PRETTY_PRINT));
    header("Location: forum.php");
    exit();
}

// Handle deleting a discussion question
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_question_id'])) {
    $discussions = array_filter($discussions, function ($discussion) {
        return $discussion['id'] !== $_POST['delete_question_id'];
    });

    file_put_contents($discussionFile, json_encode(array_values($discussions), JSON_PRETTY_PRINT));
    header("Location: forum.php");
    exit();
}

// Handle deleting an image from showcase
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_image_id'])) {
    foreach ($showcase as $key => $entry) {
        if ($entry['id'] === $_POST['delete_image_id']) {
            if (file_exists($entry['image'])) {
                unlink($entry['image']); // Delete the actual image file
            }
            unset($showcase[$key]); // Remove entry from JSON
        }
    }

    file_put_contents($showcaseFile, json_encode(array_values($showcase), JSON_PRETTY_PRINT));
    header("Location: forum.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum & Garden Showcase</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="#">Community Forum</a>
    </div>
</nav>

<div class="container mt-4">
    <!-- Toggle Buttons -->
    <div class="mb-3">
        <button class="btn btn-primary" onclick="showSection('discussion')">🗣 Discussion Forum</button>
        <button class="btn btn-success" onclick="showSection('showcase')">🌿 Garden Showcase</button>
    </div>

    <!-- Discussion Forum Section -->
    <div id="discussionSection">
        <h2>🗣 Discussion Forum</h2>
        <form method="POST" class="mb-3">
            <input type="text" name="question" class="form-control" placeholder="Ask a question..." required>
            <button type="submit" class="btn btn-primary mt-2">Post</button>
        </form>
        
        <?php foreach ($discussions as $discussion): ?>
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <?= htmlspecialchars($discussion['question']) ?>
                </div>
                <div class="card-body">
                    <form method="POST" class="mb-2">
                        <input type="hidden" name="question_id" value="<?= $discussion['id'] ?>">
                        <input type="text" name="answer" class="form-control" placeholder="Write an answer..." required>
                        <button type="submit" class="btn btn-success mt-2">Submit Answer</button>
                    </form>
                    
                    <form method="POST" class="mt-2">
                        <input type="hidden" name="delete_question_id" value="<?= $discussion['id'] ?>">
                        <button type="submit" class="btn btn-danger">Delete Question</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Garden Showcase Section -->
    <div id="showcaseSection" style="display:none;">
        <h2>🌿 Showcase Your Garden</h2>
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required>
            <input type="text" name="address" class="form-control mb-2" placeholder="Your Address" required>
            <input type="file" name="image" class="form-control mb-2" required>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>

        <div class="row">
            <?php foreach ($showcase as $entry): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <?= htmlspecialchars($entry['name'] ?? 'Anonymous') ?> - <?= htmlspecialchars($entry['address'] ?? 'Unknown Location') ?>
                        </div>
                        <img src="<?= $entry['image'] ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                        <form method="POST" class="d-inline">
                        <input type="hidden" name="like_id" value="<?= isset($entry['id']) ? htmlspecialchars($entry['id']) : '' ?>">

                            <button type="submit" class="btn btn-outline-primary">
                                👍 Like (<?= $entry['likes'] ?? 0 ?>)
                            </button>
                        </form>
                        <form method="POST" class="d-inline">
                        <input type="hidden" name="delete_image_id" value="<?= isset($entry['id']) ? htmlspecialchars($entry['id']) : '' ?>">

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function showSection(section) {
    document.getElementById('discussionSection').style.display = section === 'discussion' ? 'block' : 'none';
    document.getElementById('showcaseSection').style.display = section === 'showcase' ? 'block' : 'none';
}
</script>
</body>
</html>