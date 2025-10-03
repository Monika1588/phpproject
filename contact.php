<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f0f8f5; 
            margin: 0; 
            padding: 0; 
            text-align: center;
        }

        header {
            background: #2e7d32; 
            color: white; 
            padding: 15px 0; 
            font-size: 24px;
        }

        .contact-container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
            animation: fadeIn 1.5s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h2 {
            color: #2e7d32;
            font-size: 32px;
        }

        .contact-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            gap: 20px;
        }

        .contact-form, .contact-info {
            width: 50%;
            max-width: 500px;
            padding: 20px;
            border-radius: 10px;
            background: #e8f5e9;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out;
            text-align: left;
        }

        .contact-form:hover, .contact-info:hover {
            transform: scale(1.05);
            background: #c8e6c9;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .contact-form button {
            background: #2e7d32;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
            width: 100%;
        }

        .contact-form button:hover {
            background: #1b5e20;
        }

        .contact-info h3 {
            color: #2e7d32;
            font-size: 24px;
        }

        .contact-info p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .contact-info i {
            font-size: 22px;
            color: #2e7d32;
            margin-right: 10px;
        }

        footer {
            margin-top: 30px;
            padding: 15px;
            background: #2e7d32;
            color: white;
            font-size: 18px;
            transition: background 0.3s ease-in-out;
        }

        footer:hover {
            background: #1b5e20;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media screen and (max-width: 768px) {
            .contact-form, .contact-info {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Contact Us</h1>
</header>

<div class="contact-container">
    <h2>🌿 Get in Touch with E-Garden Hub</h2>
    <p style="font-size:18px; color:#555;">
        Have any questions or need assistance? Fill out the form below or reach out to us via the contact details provided. We are always happy to help! 🌱✨
    </p>

    <div class="contact-content">
        <!-- Contact Form -->
        <div class="contact-form">
            <h3>📩 Send Us a Message</h3>
            <form action="process_contact.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="contact-info">
            <h3>📍 Contact Information</h3>
            <p><i class="fas fa-map-marker-alt"></i> Location: <b>Jalendhar, punjab</b></p>
            <p><i class="fas fa-phone"></i> Phone: <b>2345165432</b></p>
            <p><i class="fas fa-envelope"></i> Email: <b>gardenhub@gmail.com</b></p>
            <p><i class="fas fa-globe"></i> Website: <b>https://www.egardenhub.in</b></p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 Nurseryy. All Rights Reserved.</p>
</footer>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- JavaScript Alert on Successful Submission -->
<?php if (isset($_GET['submitted']) && $_GET['submitted'] == 'true'): ?>
<script>
    alert("Your message has been submitted successfully!");
</script>
<?php endif; ?>

</body>
</html>
