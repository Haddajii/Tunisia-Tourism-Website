<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

include_once '../config.php';
include_once '../model/user.php';

$pdo = config::getConnexion();
$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Login logic...
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $loggedInUser = $userModel->login($email, $password);
            if ($loggedInUser) {
                session_start();
                $_SESSION['user_id'] = $loggedInUser['id'];
                $_SESSION['username'] = $loggedInUser['username'];
                $_SESSION['user_photo'] = $loggedInUser['photo'];
                $_SESSION['user_email'] = $loggedInUser['email'];
                
                // Check user role and redirect accordingly
                if ($loggedInUser['role'] == 1) {
                    header('Location: ../view/dashboard.php'); // Redirect to dashboard for admin
                } else {
                    header('Location: ../view/home.php'); // Redirect to home page for regular users
                }
                exit;
            } else {
                header('Location: ../view/login.php?error=Invalid email or password');
                exit;
            }
        } else {
            header('Location: ../view/login.php?error=Email and password are required');
            exit;
        }
    } elseif (isset($_POST['register'])) {

        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && isset($_FILES['photo'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $photo = $_FILES['photo']['name'];
            $target_dir = "../uploads/"; 
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("jpg", "png");

            if (in_array($imageFileType, $extensions_arr)) {
            
                $existingUser = $userModel->getUserByEmail($email);
                if ($existingUser) {
                    header('Location: ../view/login.php?error=Email is already taken');
                    exit;
                }

               
                $verificationToken = bin2hex(random_bytes(32));

               
                $userRegistered = $userModel->register($name, $email, $password, $photo, $verificationToken);
                if ($userRegistered) {
                    
                    $verificationLink = 'http://localhost/zaytouna/view/login.php?email=' . urlencode($email) . '&token=' . $verificationToken;

                   
                    $sendEmailResult = sendVerificationEmail($name,$email, $verificationLink);
                    if ($sendEmailResult) {
                        
                        header('Location: ../view/login.php?error=An email containing a verification link has been sent to your email address. Please check your inbox');
                        exit;
                    } else {
                        // Failed to send verification email
                        header('Location: ../view/login.php?error=Failed to send verification email');
                        exit;
                    }
                } else {
                    // Failed to register user
                    header('Location: ../view/login.php?error=Failed to register user');
                    exit;
                }
            } else {
                // Invalid file type
                header('Location: ../view/login.php?error=Invalid file type. Allowed types: jpg, png');
                exit;
            }
        } else {
            // All fields are required for registration
            header('Location: ../view/login.php?error=All fields are required for registration');
            exit;
        }
    } else {
        // Invalid request
        header('Location: ../view/login.php?error=Invalid request');
        exit;
    }
}

function sendVerificationEmail($name,$toEmail, $verificationLink) {
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
    $mail->Subject = 'Account Verification';
    $content = "<body style=\"font-family: 'Arial', sans-serif; background-color: #f4f4f4; padding: 20px;\">
    <div style=\"max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\">
    
    <h2 style=\"color: #333;\">Hello $name,</h2>
    <p style=\"color: #555;\">Thank you for joining ZAYTOUNA, the vibrant community who wants to make tunisia a powerhouse in tourism!</p>
    <p style=\"color: #555;\">To get started with our experince, please verify your email address by clicking the link below:</p>
    <p style=\"text-align: center; margin: 30px 0;\">
        <a href='http://localhost/zaytouna/view/login.php?token=$verificationLink' style=\"display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;\">Verify Email</a>
    </p>
    <p style=\"color: #555;\">If you did not sign up for ZAYTOUNA, you can ignore this email.</p>
    <p style=\"color: #555;\">Thank you for being part of the ZAYTOUNA community!</p>
    </div>
</body>";
$mail->isHTML(true);
$mail->Body = $content;

    return $mail->send();
}
?>
