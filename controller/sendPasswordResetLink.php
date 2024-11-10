<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetPassword'])) {
    if (!empty($_POST['resetEmail'])) {
        $email = $_POST['resetEmail'];

        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $verificationLink = generateVerificationLink($email);
            $sendEmailResult = sendPasswordResetEmail($email, $verificationLink);

            if ($sendEmailResult) {
                header('Location: ../view/login.php?error=An email containing a verification link has been sent to your email address.');
                echo '<script>alert("A verification link has been sent to your email.");</script>';
                
                
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to send email."));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Email not found in our records."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Please provide an email address."));
    }
}

function generateVerificationLink($email) {
    $verificationLink = "http://localhost/zaytouna/view/reset_password.php?email=" . urlencode($email);
    return $verificationLink;
}

function sendPasswordResetEmail($toEmail, $verificationLink) {
    require '../vendor/autoload.php'; 
    
    $mail = new PHPMailer();
    
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'a.mon14303@gmail.com';
    $mail->Password =  'ukws byfn ttqy olqc';
    
    $mail->setFrom('a.mon14303@gmail.com', 'ZAYTUNA');
    $mail->addAddress($toEmail);
    $mail->Subject = 'Password Reset';
    $content = "<body style=\"font-family: 'Arial', sans-serif; background-color: #f4f4f4; padding: 20px;\">
    <div style=\"max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\">
    
    <h2 style=\"color: #333;\">Password Reset</h2>
    <p style=\"color: #555;\">You have requested to reset your password for your ZAYTUNA account.</p>
    <p style=\"color: #555;\">To reset your password, please click the link below:</p>
    <p style=\"text-align: center; margin: 30px 0;\">
        <a href='$verificationLink' style=\"display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;\">Reset Password</a>
    </p>
    <p style=\"color: #555;\">If you did not request a password reset, you can ignore this email.</p>
    <p style=\"color: #555;\">Thank you!</p>
    </div>
</body>";
    $mail->isHTML(true);
    $mail->Body = $content;

    return $mail->send();
}
?>
