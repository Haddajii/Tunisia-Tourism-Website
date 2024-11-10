<?php
session_start();

include_once "../config.php";
include_once "../model/post.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    
    if (isset($_SESSION['user_id'])) {
        $text = $_POST["message"];
        $userId = $_SESSION['user_id'];

       
        $post = new Post( $userId,$text);

        // Save the post
        $success = $post->save();

       
        if ($success) {
            
            header('Content-Type: application/json');
            echo json_encode(["success" => true]);
            exit(); 
        } else {
          
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Failed to add post."]);
            exit();
        }
    } else {
       
        header('Content-Type: application/json');
        echo json_encode(["success" => false, "message" => "User is not logged in."]);
        exit();
    }
} else {

    header('Content-Type: application/json');
    echo json_encode(["success" => false, "message" => "Invalid request."]);
    exit();
}
?>
