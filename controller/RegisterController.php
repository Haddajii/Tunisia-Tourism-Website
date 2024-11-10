<?php
//maban dinommou hal code 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once '../config.php';
include_once '../model/user.php';

$pdo = config::getConnexion();
$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
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
                    echo json_encode(array("status" => "error", "message" => "Email is already taken"));
                    exit;
                }

                $verificationToken = bin2hex(random_bytes(32));

                $userRegistered = $userModel->register($name, $email, $password, $photo, $verificationToken);
                if ($userRegistered) {
                    $verificationLink = 'http://localhost/zaytouna/view/login.php?email=' . urlencode($email) . '&token=' . $verificationToken;

                    $sendEmailResult = sendVerificationEmail($email, $verificationLink);
                    if ($sendEmailResult) {
                        echo json_encode(array("status" => "success", "message" => "An email containing a verification link has been sent to your email address. Please check your inbox"));
                        exit;
                    } else {
                        echo json_encode(array("status" => "error", "message" => "Failed to send verification email"));
                        exit;
                    }
                } else {
                    echo json_encode(array("status" => "error", "message" => "Failed to register user"));
                    exit;
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "Invalid file type. Allowed types: jpg, png"));
                exit;
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "All fields are required for registration"));
            exit;
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Invalid request"));
        exit;
    }
}

function sendVerificationEmail($toEmail, $verificationLink) {
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
    $mail->Body = 'Click the following link to verify your account: ' . $verificationLink;

    return $mail->send();
}
?>
