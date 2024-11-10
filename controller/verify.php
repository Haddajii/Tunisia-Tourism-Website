<?php
include_once '../config.php';
include_once '../model/user.php';

$pdo = config::getConnexion();
$userModel = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

   
    $user = $userModel->getUserByEmail($email);

   
    if ($user && $user['verification_token'] === $token) {
      
        $userRegistered = $userModel->register($user['name'], $user['email'], $user['password'], $user['photo']);

        if ($userRegistered) {
           
            header('Location: ../view/login.php?success=Account registered successfully. You can now login.');
            exit;
        } else {
          
            header('Location: ../view/login.php?error=Failed to register user.');
            exit;
        }
    } else {
    
        header('Location: ../view/login.php?error=Invalid verification link.');
        exit;
    }
} else {
   
    header('Location: ../view/login.php?error=Invalid request.');
    exit;
}
?>
