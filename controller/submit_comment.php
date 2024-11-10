<?php

session_start();

include_once "../config.php";
include_once "../model/Comment.php";

// Check if data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $postId = $_POST['postId'];
    $userId = $_SESSION['user_id']; // Assuming you have user session
    $commentText = $_POST['commentContent']; // Corrected to match textarea id

    // Create a new Comment object
    $comment = new Comment($postId, $userId, $commentText);

    // Save the comment to the database
    if ($comment->save()) {
        // Return success response
        echo json_encode(array("success" => true));
    } else {
        // Return error response
        echo json_encode(array("success" => false, "message" => "Failed to save comment"));
    }
} else {
    // Return error response if request method is not POST
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
