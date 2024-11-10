<?php
session_start();
include_once "../config.php";
include_once "../model/post.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['postId'])) {
        $postId = $_POST['postId'];
        $post = new Post(null, null); // Create an instance of Post to call the delete method
        if ($post->deletePost($postId)) {
            echo "Post deleted successfully!";
        } else {
            echo "Failed to delete post!";
        }
    } else {
        echo "Post ID is missing!";
    }
} else {
    echo "Invalid request method!";
}
?>
