<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data (you can save it to database or send an email here)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Example: Save or email can be added here...

    // Redirect to contact page with success message
    header("Location: contact.php?submitted=true");
    exit();
}
?>
