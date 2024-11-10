<?php
session_start();

include_once "../config.php"; 


if (isset($_SESSION['user_id'])) {
    $pdo = config::getConnexion();
   
    if (isset($pdo) && $pdo !== null) {
        $userId = $_SESSION['user_id'];

        try {
            
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$userId]);

            
            if ($stmt->rowCount() > 0) {
                
                $_SESSION = array();
                session_destroy();
                header("Location: ../view/home.php");
                exit();
            } else {
                
                header("Location: deletAccount.php");
                exit();
            }
        } catch (PDOException $e) {
           
            $_SESSION['delete_account_error'] = "Database error: " . $e->getMessage();
            header("Location: deletAccount.phpp");
            exit();
        }
    } else {
        
        $_SESSION['delete_account_error'] = "Database connection error: Database connection is not established.";
        header("Location: deletAccount.php");
        exit();
    }
} else {
    
    header("Location: login.php");
    exit();
}
?>
