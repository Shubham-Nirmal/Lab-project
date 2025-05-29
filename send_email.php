<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/labserv_india/labserveindia(latest)/src/Exception.php';
require 'C:/xampp/htdocs/labserv_india/labserveindia(latest)/src/PHPMailer.php';
require 'C:/xampp/htdocs/labserv_india/labserveindia(latest)/src/SMTP.php';


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars(trim($_POST['first-name']));
    $lastName = htmlspecialchars(trim($_POST['last-name']));
    $role = htmlspecialchars(trim($_POST['role']));
    $organization = htmlspecialchars(trim($_POST['organization']));
    $contactNumber = htmlspecialchars(trim($_POST['contact-number']));
    $customerEmail = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $question = htmlspecialchars(trim($_POST['question']));

    // Basic validation
    if (empty($firstName) || empty($lastName) || empty($contactNumber) || empty($customerEmail) || empty($address)) {
        echo "<script>alert('Please fill in all required fields.');</script>";
        exit;
    }

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gawarepriyanka520@gmail.com';
        $mail->Password = 'kfbptxpljwvypypv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('gawarepriyanka520@gmail.com', 'Form Submission');
        $mail->addAddress('gawarepriyanka520@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission';
        $mail->Body    = "
        <strong>Name:</strong> $firstName $lastName<br>
        <strong>Role:</strong> $role<br>
        <strong>Organization:</strong> $organization<br>
        <strong>Contact Number:</strong> $contactNumber<br>
        <strong>Email:</strong> $customerEmail<br>
        <strong>Address:</strong> $address<br>
        <strong>Question:</strong> $question
        ";

        // Send email
        $mail->send();

        // Display success message and redirect
        echo "<script>
                alert('Form submitted successfully!');
                setTimeout(function() {
                    window.location.href = 'contact.php';
                }, 1000); // 1-second delay before redirecting
              </script>";
        exit;

    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}
?>
