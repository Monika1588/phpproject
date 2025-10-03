<?php
// Start session (if needed for future user comments)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardening Tips & Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .blog-header {
            background: url('https://source.unsplash.com/1600x500/?gardening,plants') no-repeat center center/cover;
            text-align: center;
            color: white;
            padding: 80px 20px;
        }
        .blog-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
        }
        .blog-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .blog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .footer {
            background: #222;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        .footer i:hover {
            color: #28a745;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-seedling"></i> E-Garden Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php">Gardening Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Blog Header -->
<div class="blog-header">
    <h1>🌿 Gardening Tips & Blog</h1>
    <p>Learn expert gardening techniques, seasonal care guides, and DIY ideas!</p>
</div>

<!-- Blog Section -->
<div class="container mt-5">
    <div class="row">
        <!-- Featured Blog Post -->
        <div class="col-md-6">
            <div class="blog-card shadow-sm p-3 mb-4">
                <img src="https://source.unsplash.com/600x300/?houseplants" alt="Gardening Tips">
                <div class="p-3">
                    <h4>🌱 Best Plants for Beginners</h4>
                    <p>Start with low-maintenance plants like Snake Plant, Aloe Vera, and Pothos.</p>
                    <a href="article.php?id=best-plants" class="btn btn-success btn-sm">Read More</a>
                </div>
            </div>
        </div>

        <!-- Other Blog Articles -->
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item"><a href="article.php?id=seasonal-care" class="text-decoration-none">🌻 Seasonal Plant Care Guide</a></li>
                <li class="list-group-item"><a href="article.php?id=diy-garden" class="text-decoration-none">🛠️ DIY Gardening Ideas</a></li>
                <li class="list-group-item"><a href="article.php?id=organic-fertilizers" class="text-decoration-none">🍃 Organic Fertilizers for Healthy Growth</a></li>
                <li class="list-group-item"><a href="article.php?id=pest-control" class="text-decoration-none">🐞 Natural Pest Control Tips</a></li>
                <li class="list-group-item"><a href="article.php?id=composting" class="text-decoration-none">♻️ Easy Composting Techniques</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer mt-5">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> E-Garden Hub. All rights reserved.</p>
        <div>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
