<?php
session_start();
include_once "../config.php";
include_once "../model/Comment.php";

if (isset($_POST['postId'])) {
    $postId = $_POST['postId'];
    $comments = Comment::getCommentsByPostId($postId);
    if ($comments !== null) {
        $formattedComments = [];
        foreach ($comments as $comment) {
            // Retrieve username and user photo using functions from the model
            $username = Comment::getUsernameByUserId($comment['userId']);
            $formattedComments[] = [
                'username' => $username,
                'date' => $comment['date'],
                'content' => $comment['content']
            ];
        }
        echo json_encode($formattedComments);
    } else {
        // Return an empty array if there are no comments or error occurred
        echo json_encode([]);
    }
}
?>
