<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

// Get data from AJAX request
$recipientEmail = $_POST['recipientEmail'];
$emailContent = $_POST['emailContent'];

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'a.mon14303@gmail.com';
    $mail->Password = 'ukws byfn ttqy olqc';

    // Sender and recipient
    $mail->setFrom('a.mon14303@gmail.com', 'ZAYTUNA');
    $mail->addAddress($recipientEmail);

    // Email content
    $mail->isHTML(false);
    $mail->Subject = 'New message from ZAYTUNA';
    $mail->Body = $emailContent;

    // Send email
    $mail->send();
    
    // Success response
    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
} catch (Exception $e) {
    // Error response
    echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
}
?>
