<?php
include("dashbSides.php");
include_once "../model/post.php";

$posts = Post::getAllPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Document</title>
    <style>
        .recent-orders table img {
            max-width: 50px;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 50%;
        }
        
        .delete-btn {
            background-color: var(--color-danger);
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Icon style */
        .delete-icon {
            margin-right: 5px;
        }

        /* Animation on hover */
        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<main>
    <div class="recent-orders all">
        <h2>Posts</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Text</th>
                <th>Date</th>
                <th>Likes</th>
                <th>Dislikes</th>
                <th>User Name</th>
                <th>User Photo</th>
                <th>Action</th> <!-- Added column for Delete button -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo $post['id']; ?></td>
                    <td><?php echo $post['text']; ?></td>
                    <td><?php echo $post['date']; ?></td>
                    <td><?php echo $post['likes']; ?></td>
                    <td><?php echo $post['dislikes']; ?></td>
                    <td><?php echo (new Post($post['userId'], ''))->getUsername(); ?></td>
                    <td><img src="../uploads/<?php echo (new Post($post['userId'], ''))->getUserPhoto(); ?>" alt="User Photo"></td>
                    <td>
                        <button class="delete-btn" data-post-id="<?php echo $post['id']; ?>">
                            <i class="fas fa-trash delete-icon"></i> Delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
   $(document).ready(function() {
    $('.delete-btn').click(function() {
        var postId = $(this).data('post-id');
        
        // Display confirmation dialog before deleting
        if (confirm("Are you sure you want to delete this post?")) {
            $.ajax({
                url: '../controller/delete_post.php',
                method: 'POST',
                data: { postId: postId },
                success: function(response) {
                    alert(response);
                    // Refresh the page or remove the deleted row from the table
                    // For now, let's reload the page
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error occurred while deleting post!');
                }
            });
        }
    });
});


</script>
<script src="../assets/js/admin.js"></script>
</body>
</html>
