<?php
  include("dashbSides.php") ;
  include_once "../model/user.php";

$users = User::getAllUsers();
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
            max-width: 100px; 
            height: auto; 
            display: block; 
            margin: 0 auto; 
           }
          
           .send-email-btn {
        background-color: #6C9BCF;
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

    /* Animation on hover */
    .send-email-btn:hover {
        background-color: #45a049;
      
    }

    /* Icon style */
    .email-icon {
        margin-right: 5px;
    }

    /* Text area style */
    .email-window {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            z-index: 1000;
            width: 300px; /* Adjust width as needed */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-window textarea {
            width: calc(100% - 20px); /* Adjust width as needed */
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            font-size: 14px;
        }

        .email-window button {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #6C9BCF;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .email-window button:hover {
            background-color: #45a049;
        }

        .close-btn {
            background-color: #ccc;
            color: #000;
            margin-top: 10px;
        }

        .close-btn:hover {
            background-color: #bbb;
        }
        
    </style>
</head>
<body>
<main>
        <div class="recent-orders all">
            <h2>Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Photo</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td class="user-email"><?php echo $user['email']; ?></td>
                            <td><?php echo $user['password']; ?></td>
                            <td style="width: 50px; height: 50px; overflow: hidden; border-radius: 50%;"><img src="../uploads/<?php echo $user['photo']; ?>" alt="User Photo" style="width: 100%; height: 100%; object-fit: cover;"></td>
                            <td style="color: <?php echo ($user['role'] == 1) ? 'red' : 'green'; ?>"><?php echo ($user['role'] == 1) ? 'Admin' : 'User'; ?></td>
                            <td>
                            <button class="send-email-btn" data-email="<?php echo $user['email']; ?>"> <i class="fas fa-envelope email-icon"></i> Send Email</button>
                            <div class="email-window" style="display: none;">
                                <textarea class="email-textarea" rows="4" cols="30"></textarea>
                                <button class="send-btn">Send</button>
                                <button class="close-btn">Close</button>
                            </div>
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
        $('.send-email-btn').click(function() {
            var emailWindow = $(this).next('.email-window');
            emailWindow.toggle();
        });

        $('.send-btn').click(function() {
            var emailTextarea = $(this).prev('.email-textarea');
            var recipientEmail = $(this).closest('tr').find('.user-email').text(); 
            var emailContent = emailTextarea.val();

            $.ajax({
                url: '../controller/send_email.php',
                method: 'POST',
                data: {
                    recipientEmail: recipientEmail,
                    emailContent: emailContent
                },
                success: function(response) {
                    alert('Email sent successfully!');
                    emailTextarea.val('');
                    emailTextarea.closest('.email-window').hide();
                },
                error: function(xhr, status, error) {
                    alert('Error occurred while sending email!');
                }
            });
        });

        $('.close-btn').click(function() {
            $(this).closest('.email-window').hide();
        });
    });
</script>



    
    

    <script src="../assets/js/admin.js"></script>   
</body>
</html>