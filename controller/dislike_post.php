<?php
// dislike_post.php
include_once "../model/post.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['postId'];

    $post = new Post(null, null, $postId);
    $success = $post->dislikePost();

    echo json_encode(['success' => $success]);
}
?>
