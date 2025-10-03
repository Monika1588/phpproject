<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-Garden Hub</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f0f8f5; 
            margin: 0; 
            padding: 0; 
            text-align: center;
            overflow-x: hidden;
        }

        header {
            background: #2e7d32; 
            color: white; 
            padding: 15px 0; 
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .about-container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
            animation: fadeIn 1.5s ease-in-out;
        }

        h2 {
            color: #2e7d32;
            font-size: 32px;
            animation: bounce 1.5s ease-in-out infinite alternate;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-5px); }
        }

        .about-text {
            width: 80%;
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            margin: auto;
        }

        .our-team {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 30px 0;
        }

        .team-member {
            text-align: center;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
            width: 200px;
        }

        .team-member:hover {
            transform: scale(1.1);
            background: #c8e6c9;
        }

        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
        }

        .why-choose-us {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 30px 0;
        }

        .why-card {
            background: #e8f5e9;
            padding: 20px;
            border-radius: 8px;
            width: 250px;
            transition: all 0.3s ease-in-out;
            text-align: center;
        }

        .why-card:hover {
            background: #c8e6c9;
            transform: scale(1.05);
        }

        .why-card i {
            font-size: 40px;
            color: #2e7d32;
        }

        .mission, .vision {
            background: #e8f5e9;
            padding: 20px;
            margin: 15px auto;
            border-radius: 8px;
            width: 70%;
            transition: all 0.3s ease-in-out;
        }

        .mission:hover, .vision:hover {
            background: #c8e6c9;
            transform: scale(1.05);
        }

        footer {
            margin-top: 30px;
            padding: 20px;
            background: #2e7d32;
            color: white;
            font-size: 18px;
            transition: background 0.5s ease-in-out;
        }

        footer:hover {
            background: #1b5e20;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<header>
    <h1>About Us</h1>
</header>

<div class="about-container">
    <h2>Welcome to E-Garden Hub 🌿</h2>
    <p class="about-text">
        E-Garden Marketplace is your one-stop destination for vibrant, high-quality plants. We bring you the best of nature, 
        offering a wide range of indoor and outdoor plants, exotic species, herbs, and flowers. Our mission is 
        to make the world greener, one plant at a time! 🌱
    </p>
<h2>Our Team</h2>
    <div class="our-team">
        <div class="team-member">
            <img src="https://www.nurseryworld.co.uk/media/n4pbd5lg/ollie-humphries-ceo-family-first.jpg?width=1002&height=668&bgcolor=White&v=1da9cae20e67e30" alt="Team Member 1">
            <h4>John Doe</h4>
            <p>Founder & CEO</p>
        </div>
        <div class="team-member">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMTXqHqKOr6IrNVcZ4-SbPheNrNyi8voTzOJXyd2UhoA2QfaR-X2cjnOEFxGb1puKKy-0&usqp=CAU" alt="Team Member 2">
            <h4>Jane Smith</h4>
            <p>Plant Specialist</p>
        </div>
        <div class="team-member">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKN2Arp86V46Q0IQ2Y4apfiCuvkm12vukzLy3sR8k25_ZC5YFLE0qH3wb1DpWZ3JF4mBA&usqp=CAU" alt="Team Member 2">
            <h4>Jane Smith</h4>
            <p>Plant Specialist</p>
        </div>
        <div class="team-member">
            <img src="https://media.licdn.com/dms/image/sync/v2/D4E27AQErXQsrLikeDA/articleshare-shrink_800/articleshare-shrink_800/0/1713624230183?e=2147483647&v=beta&t=4wRZG9NVdzh4z65F4IdDCgnTq5c-k3HQfi4WDetSjaE" alt="Team Member 2">
            <h4>Jane Smith</h4>
            <p>Plant Specialist</p>
        </div>
    </div>

    <div class="mission">
        <h3>🌎 Our Mission</h3>
        <p>To create a greener, healthier, and happier world by making plants accessible and easy to care for. 
        We believe that every space—big or small—deserves a touch of nature.</p>
    </div>

    <div class="vision">
        <h3>🌍 Our Vision</h3>
        <p>To make every home a little greener and contribute to a healthier planet for future generations.</p>
    </div>

    <div class="why-choose-us">
        <div class="why-card">
            <i class="fas fa-seedling"></i>
            <h4>Premium Quality</h4>
            <p>Healthy, well-nurtured plants ready to flourish.</p>
        </div>
        <div class="why-card">
            <i class="fas fa-leaf"></i>
            <h4>Eco-Friendly</h4>
            <p>Sustainable and ethical growing practices.</p>
        </div>
        <div class="why-card">
            <i class="fas fa-truck"></i>
            <h4>Fast Delivery</h4>
            <p>Fresh plants delivered straight to your doorstep.</p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 E-Garden Hub. All Rights Reserved. | Designed with 🌱</p>
</footer>

</body>
</html>