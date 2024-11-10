<?php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate new password and confirm password
    if ($newPassword !== $confirmPassword) {
        // Passwords don't match, redirect with an error message
        header("Location: reset-password.php?error=Passwords+do+not+match");
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $pdo = config::getConnexion();
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashedPassword, $email]);

    // Redirect to login page with a success message
    header("Location: ../view/login.php?success=Password+updated+successfully");
    exit;
}
?>
