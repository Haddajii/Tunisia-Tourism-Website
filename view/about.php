<?php
   include("header.php");
   include_once "../model/post.php";
   include_once "../model/Comment.php" ;
   
   $posts = post::getAllPosts();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
    <title>Groovin Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
  
    <!-- Favicons -->
    <link href="../logo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-BOcmVvKv+1NQYgF+GhQ9G5RjDrUabT0o/OaxWNz6L8on8tgqctZ6OLq4Jkc1Fu9kjSRBI/dN3dmONd49vgdXvg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
  
    <!-- =======================================================
    * Template Name: Groovin
    * Template URL: https://bootstrapmade.com/groovin-free-bootstrap-theme/
    * Updated: Mar 17 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <style>


@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");

.like-btn,
.dislike-btn {
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer; /* Indicate clickable behavior */
  background-color: transparent; /* Transparent background */
  color: inherit; /* Inherit text color from parent element */
}

.like-btn.active,
.dislike-btn.active {
  color: #fff; /* White text color for active buttons */
}

.like-btn.active i {
  color: DodgerBlue; /* Blue for Like icon */
}

.dislike-btn.active i {
  color: Tomato; /* Red for Dislike icon */
}
    .posts-container {
    max-width: 600px; /* Adjust the width as needed */
    margin: 0 auto; /* Center the container horizontally */
}

.post {
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
}

.post-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.user-photo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ccc;
    margin-right: 10px;
}

.user-info {
    flex-grow: 1;
}

.username {
    font-weight: bold;
    margin-right: 10px;
}

.post-date {
    color: #666;
}

.post-content {
    margin-bottom: 10px;
}

.post-actions {
    display: flex;
}

.like-btn,
.dislike-btn {
    margin-right: 10px;
    padding: 5px 10px;
    font-size: 14px;
}

.custom-link {
    cursor:pointer ;
}


</style>
</head>
<body>
  <section id="hero">
      <div class="hero-container">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

          <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

          <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active">
              <div class="carousel-container">
                <div class="carousel-content">
                  <h2 class="animate__animated animate__fadeInDown">About Us </h2>
                  <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                  <div>
                    <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                  </div>
                </div>
              </div>
            </div>
  </section>

     <!-- ======= Frequently Asked Questions Section ======= -->
     <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section>

    
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>A108 Adam Street, NY 535022, USA</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@example.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <form id="comment-form" action="../controller/postController.php" method="post" role="form" class="php-email-form">
          <div class="section-title">
          <h2>Forum</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" ></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit" name="forum">Send Message</button></div>
          </form>
        </div>

      </div>
    </section>

    <div class="recent-posts all">
        
        <div class="posts-container">
            <?php foreach ($posts as $post): ?>
              <div class="post">
    <div class="post-header">
       
        <img src="../uploads/<?php echo (new Post($post['userId'], $post['text'], $post['id']))->getUserPhoto(); ?>" alt="User Photo" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
        <div class="user-info">
            <span class="username"><?php echo (new Post($post['userId'], $post['text'], $post['id']))->getUsername(); ?></span>
            <span class="post-date"><?php echo $post['date']; ?></span>
        </div>
    </div>
    <p class="post-content"><?php echo $post['text']; ?></p>
    <div class="post-actions">
        
        <button class="like-btn" data-post-id="<?php echo $post['id']; ?>">
            <i class="far fa-thumbs-up"></i> 
            <span class="like-count"><?php echo $post['likes']; ?></span>
        </button>
        <button class="dislike-btn" data-post-id="<?php echo $post['id']; ?>">
            <i class="far fa-thumbs-down"></i> 
            <span class="dislike-count"><?php echo $post['dislikes']; ?></span>
        </button>
        <a class="comment-link custom-link" data-bs-toggle="modal" data-bs-target="#commentsModal" data-post-id="<?php echo $post['id']; ?>">Comments</a>

    </div>
</div>

            <?php endforeach; ?>
        </div>
    </div>

<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentsModalLabel">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="comments-container">
                    <?php
                 
                    if (isset($postId)) {
                      
                        $comments = Comment::getCommentsByPostId($postId);

                        if ($comments) {
                            
                            foreach ($comments as $comment) {
                                $username = Comment::getUsernameByUserId($comment['userId']);
                                $userPhoto = Comment::getUserPhotoByUserId($comment['userId']);
                                ?>
                                <div class="comment">
                                    <div class="user-info">
                                        <?php if ($userPhoto) { ?>
                                            <img src="<?php echo $userPhoto; ?>" alt="User Photo">
                                        <?php } ?>
                                        <span class="username"><?php echo $username; ?></span>
                                    </div>
                                    <div class="comment-text"><?php echo $comment['commentText']; ?></div>
                                    <div class="comment-date"><?php echo $comment['dateCreated']; ?></div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No comments found.";
                        }

                    }
                   else {
                    echo "Post ID is not set or empty.";
                }
                    
                    ?>
                </div>
                
                
                <form id="commentForm">
                    <div class="mb-3">
                        <label for="commentContent" class="form-label">Your Comment</label>
                        <textarea class="form-control" id="commentContent" name="commentContent" rows="3"></textarea>
                    </div>
                    <input type="hidden" id="postId" name="postId" value="">
                    <button type="button" id="addCommentBtn" class="btn btn-primary">Add Comment</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   

    <script>
    $(document).ready(function() {
        $('.like-btn').click(function() {
            var postId = $(this).data('post-id');
            var btn = $(this);
            $.ajax({
                type: 'POST',
                url: '../controller/like_post.php', 
                data: { postId: postId },
                success: function(response) {
                    if (response.success) {
                        
                        var likeCount = parseInt(btn.find('.like-count').text());
                        btn.find('.like-count').text(likeCount + 1);
                        btn.addClass('active');
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('.dislike-btn').click(function() {
            var postId = $(this).data('post-id');
            var btn = $(this);
            $.ajax({
                type: 'POST',
                url: '../controller/dislike_post.php', 
                data: { postId: postId },
                success: function(response) {
                    if (response.success) {
                        
                        var dislikeCount = parseInt(btn.find('.dislike-count').text());
                        btn.find('.dislike-count').text(dislikeCount + 1);
                        btn.addClass('active');
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
$(document).ready(function() {
    $('.comment-link').click(function() {
        var postId = $(this).data('post-id'); // Retrieve postId from data attribute
        $('#postId').val(postId); // Set the postId value in the hidden input field
    });

    $('#addCommentBtn').click(function() {
        var formData = new FormData($('#commentForm')[0]);

        $.ajax({
            type: 'POST',
            url: '../controller/submit_comment.php', 
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Comment added successfully!');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(status + ': ' + error);
                alert('Error adding comment. Please try again.');
            }
        });
    });
});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#comment-form').submit(function(event) {
        
        event.preventDefault();

       
        var formData = new FormData(this);

        
        $.ajax({
            type: 'POST',
            url: '../controller/postController.php', 
            data: formData,
            processData: false, 
            contentType: false,  
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                   
                    alert('Post added successfully!');
                } else {
                    
                    alert('Failed to add post: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                
                console.error(status + ': ' + error);
                alert('Error adding post. Please try again.');
            }
        });
    });
});

</script>



     <script>
      const likeBtn = document.querySelector('.like-btn');
const dislikeBtn = document.querySelector('.dislike-btn');

likeBtn.addEventListener('click', () => {
  likeBtn.classList.toggle('active');
  dislikeBtn.classList.remove('active'); 
});

dislikeBtn.addEventListener('click', () => {
  dislikeBtn.classList.toggle('active');
  likeBtn.classList.remove('active'); 
});
     </script>


       
       <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
      <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
      <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
      <script src="../assets/vendor/php-email-form/validate.js"></script>
    
  
      <script src="../assets/js/main.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      


     
</body>
</html>

<?php
   include("footer.html");
?>














