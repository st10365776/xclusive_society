<?php
include 'includes/header.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

if (isset($_POST['send'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['message']);

    $errors = [];

    // Validation
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z\s]{2,50}$/", $name)) {
        $errors[] = "Name must contain only letters";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required";
    }

    if (strlen($msg) < 10) {
        $errors[] = "Message must be at least 10 characters";
    }

    if (empty($errors)) {

        $mail = new PHPMailer(true);

        try {
            // SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sixolilethandani@gmail.com';

            // ⚠️ IMPORTANT: move this to env file later
            $mail->Password = 'jwuisqlfjzczpemt';

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sixolilethandani@gmail.com', 'Xclusive Society');
            $mail->addReplyTo($email, $name);
            $mail->addAddress('sixolilethandani@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "
                <h2>New Contact Message</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong><br>$msg</p>
            ";

            $mail->send();

            // Auto reply
            $mail->clearAddresses();
            $mail->addAddress($email);

            $mail->Subject = "We received your message";
            $mail->Body = "
                <h3>Hello $name</h3>
                <p>Thank you for contacting us. We will respond soon.</p>
            ";

            $mail->send();

            $message = "Message sent successfully!";

        } catch (Exception $e) {
            $message = "Email failed: " . $mail->ErrorInfo;
        }

    } else {
        $message = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .contact-container {
            min-height: calc(100vh - 100px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .contact-card {
            background: #fff;
            padding: 35px;
            border-radius: 20px;
            width: 420px;
            max-width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .contact-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
            background: #ffe0e0;
            color: #b30000;
        }

        .success {
            background: #d4f8d4;
            color: #1b5e20;
        }

        .contact-card form {
            display: flex;
            flex-direction: column;
        }

        .contact-card input,
        .contact-card textarea {
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            width: 100%;
        }

        .contact-card textarea {
            resize: none;
            height: 120px;
        }

        .contact-card button {
            padding: 12px;
            background: linear-gradient(135deg, #ff6b6b, #ff9472);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .contact-card button:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

<section class="contact-container">
    <div class="contact-card">

        <h2>Contact Us</h2>

        <?php if (!empty($message)) : ?>
            <div class="alert <?php echo ($message === "Message sent successfully!") ? 'success' : ''; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Message (min 10 characters)" required></textarea>

            <button type="submit" name="send">Send Message</button>
        </form>

    </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>