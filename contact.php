<?php
/**
 * CONTACT US PAGE
 * ===============
 * Handles customer contact form submissions.
 * Validates form data (name, email, subject, message).
 * Sends contact form emails via PHPMailer using Gmail SMTP.
 * Features:
 * - Admin notification email with contact details
 * - Auto-reply email to customer
 * - Input validation and error messages
 */

include 'includes/header.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

// Process contact form submission
if(isset($_POST['send'])){

    // Trim whitespace from inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['message']);

    $errors = [];

    // Validate name (letters and spaces only)
    if(empty($name)){
        $errors[] = "Name is required";
    } elseif(!preg_match("/^[a-zA-Z\s]{2,50}$/", $name)){
        $errors[] = "Name must contain only letters";
    }

    // Validate email format
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Valid email is required";
    }

    // Validate subject line
    if(empty($subject)){
        $errors[] = "Subject is required";
    }

    // Validate message length
    if(strlen($msg) < 10){
        $errors[] = "Message must be at least 10 characters";
    }

    // Proceed if no validation errors
    if(empty($errors)){

        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            // TODO: Update with your Gmail credentials
            $mail->Username = 'sixolilethandani@gmail.com';
            $mail->Password = 'jwuisqlfjzczpemt';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set sender information
            $mail->setFrom('sixolilethandani@gmail.com', 'Xclusive Society');
            // Allow customer reply to this email
            $mail->addReplyTo($email, $name);

            // Send email to admin inbox
            $mail->addAddress('sixolilethandani@gmail.com');

            // Format email as HTML
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "
                <h2>New Contact Message</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong><br>$msg</p>
            ";

            // Send admin notification
            $mail->send();

            // Send auto-reply to customer
            $mail->clearAddresses();
            $mail->addAddress($email);

            $mail->Subject = "We received your message";
            $mail->Body = "
                <h3>Hello $name </h3>
                <p>Thank you for contacting us. We will respond soon.</p>
            ";

            // Send auto-reply
            $mail->send();

            $message = "Message sent successfully!";

        } catch (Exception $e) {
            $message = "Email failed: " . $mail->ErrorInfo;
        }

    } else {
        // Display all validation errors
        $message = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
/* Contact form container */
.contact-container {
    min-height: calc(100vh - 100px); /* account for navbar */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

/* Contact form card styling */
.contact-card {
    background: #fff;
    padding: 35px;
    border-radius: 20px;
    width: 420px;
    max-width: 100%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

/* Form title */
.contact-card h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Alert message styling */
.contact-card .alert {
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
    text-align: center;
    font-weight: bold;
}

/* Success message styling */
.contact-card .success {
    background: #d4f8d4;
    color: #1b5e20;
}

/* Error message styling */
.contact-card .alert:not(.success) {
    background: #ffe0e0;
    color: #b30000;
}

/* Form layout */
.contact-card form {
    display: flex;
    flex-direction: column;
}

/* Form inputs and textarea */
.contact-card input,
.contact-card textarea {
    padding: 12px;
    margin-bottom: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: inherit;
}

/* Submit button */
.contact-card button {
    padding: 12px;
    background: #333;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.contact-card button:hover {
    background: #555;
}
    </style>
</head>

<body>

<section class="contact-container">
    <div class="contact-card">
        <h2>Contact Us</h2>

        <!-- Display form submission message (success or error) -->
        <?php if (!empty($message)) : ?>
            <div class="alert <?php echo strpos($message, 'successfully') !== false ? 'success' : ''; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Contact form -->
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Message (min 10 characters)" rows="5" required></textarea>
            <button type="submit" name="send">Send Message</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
.contact-card textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    outline: none;
}

/* Textarea */
.contact-card textarea {
    resize: none;
    height: 100px;
}

/* Button */
.contact-card button {
    padding: 12px;
    border: none;
    border-radius: 25px;
    background: linear-gradient(135deg, #ff6b6b, #ff9472);
    color: white;
    font-size: 16px;
    cursor: pointer;
}

/* Hover */
.contact-card button:hover {
    transform: translateY(-2px);
}
    </style>
</head>

<body>

<div class="contact-container">

    <div class="contact-card">

        <h2>Contact Us</h2>

        <?php if($message != ""): ?>
            <div class="alert <?php echo ($message == "Message sent successfully!") ? 'success' : '' ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="subject" placeholder="Subject" required>

            <textarea name="message" rows="5" placeholder="Your Message..." required></textarea>

            <button name="send">Send Message</button>

        </form>

    </div>

</div>

</body>
</html>