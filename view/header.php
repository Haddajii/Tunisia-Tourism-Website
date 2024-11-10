<?php
session_start();

include_once "../config.php";
include_once "../model/reservation.php"; 
include_once "../model/booking.php" ;

$username = "";
$photo = "";

if (isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    if(isset($_SESSION['user_photo'])) {
        $photo = $_SESSION['user_photo'];
    }
}

if (isset($_POST['logout'])) {
    
    $_SESSION = array();
    
    session_destroy();
 
    header("Location: home.php");
    exit();
}


function getReservationsByUserId($userId) {
    $reservations = Reservation::getReservationByUserId($userId);
    if ($reservations) {
        return $reservations;
    } else {
        return false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Zaytuna</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    
    <link href="../logo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

   
    <link href="../assets/css/style.css" rel="stylesheet">


    <style>
        #loading-image {
  width: 100px; /* Adjust width as needed */
  height: 100px; /* Adjust height as needed */
  /* Center the image within the loading screen */
  margin: 0 auto; /* Vertical centering */
  position: absolute; /* Ensures centering works within the loading screen */
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); /* Horizontal centering */
}
            #chatbot-button {
                position: fixed;
                bottom: 20px;
                left: 20px;
                z-index: 9999;
                background-color: #5c9f24; 
                color: #fff; 
                border: none; 
                border-radius: 5px; 
                padding: 10px 20px; 
                cursor: pointer; 
                outline: none; 
            }

            #chatbot-button:hover {
                background-color: #4b8020;
            }

            .chatbot-window {
    display: none;
    position: fixed;
    bottom: 60px;
    left: 20px; 
    width: 300px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.chatbot-messages {
    height: 300px; 
    overflow-y: auto;
    padding: 10px;
    display: flex;
    flex-direction: column; 
}

.user-input-container {
    display: flex;
    align-items: center;
    padding: 10px;
    border-top: 1px solid #ccc;
}

.user-input {
    flex: 1;
    padding: 8px;
    border: none;
    border-radius: 20px;
    margin-right: 10px;
    outline: none;
}

.send-button {
    padding: 8px 20px;
    background-color: #5c9f24;
    color: #fff;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    outline: none;
}

.chatbot-message {
    background-color: #5c9f24;
    color: #fff;
    border-radius: 15px;
    padding: 10px;
    margin: 10px 20px;
    max-width: 70%;
}

.user-message {
    background-color: #e9e9e9;
    color: #333;
    border-radius: 15px;
    padding: 10px;
    margin: 10px 20px;
    max-width: 70%;
    align-self: flex-start; /* Align user messages to the left */
}


  


        .btn .btn-secondary{
            background-color: #5c9f24 ;
        }
        
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #eaf6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #loading-text {
            font-size: 24px;
        }

        #content {
            display: none;
        }

        .bi-cart-check-fill{
            cursor: pointer;
            
        }
      
    </style>
</head>

<body>
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="home.php" class="logo"><img src="../logo.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="home.php" class="nav-link scrollto ">Home</a></li>
                    <li><a href="about.php" class="nav-link scrollto">About</a></li>
                    <li><a class="nav-link scrollto " href="shop.php">Shop</a></li>

                  
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (!empty($photo)) { ?>
                                    <img src="../uploads/<?php echo $photo; ?>" alt="User Photo" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                <?php } ?>
                                <span class="ms-2 d-none d-lg-inline text-white"><?php echo $username; ?></span>
                            </a>
                            
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><form id="logoutForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <button class="dropdown-item" type="submit" name="logout">Logout</button>
                                </form></li>
                            </ul>
                        </li>
                        <li><i class="bi bi-cart-check-fill" data-bs-toggle="modal" data-bs-target="#shopping-cart-window"></i></li>

                    <?php } else { ?>
                        <li><a href="login.php" class="getstarted scrollto" id="getstarted">Get Started</a></li>
                    <?php } ?>
                    
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>


    <div id="loading-screen">
    <img id="loading-image" src="../gif.gif" alt="Loading Animation">
  </div>

    
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Existing profile content -->
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div class="d-flex align-items-center mb-3">
                        <?php if (!empty($photo)) { ?>
                            <img src="../uploads/<?php echo $photo; ?>" alt="User Photo" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <?php } ?>
                        <div>
                            <h5 class="modal-title"><?php echo $username; ?></h5>
                            <p class="text-muted"><?php echo $_SESSION['user_email']; ?></p>
                        </div>
                    </div>
                    
                <?php } else { ?>
                    <p>User not logged in.</p>
                <?php } ?>

               
                <form id="updateUserForm" method="post">
                <div class="mb-3">
                    <label for="updateUsername" class="form-label">Update Username</label>
                    <input type="text" class="form-control" id="updateUsername" name="updateUsername">
                </div>
                <div class="mb-3">
                    <label for="updateEmail" class="form-label">Update Email</label>
                    <input type="email" class="form-control" id="updateEmail" name="updateEmail">
                </div>
                <div class="mb-3">
                    <label for="updatePhoto" class="form-label">Update Photo</label>
                    <input type="file" class="form-control" id="updatePhoto" name="updatePhoto">
                </div>
                <button type="button" class="btn btn-primary" id="updateUserBtn">Update Information</button>
            </form>

            <!-- Button to delete account -->
            <form method="post" action="../controller/deletAccount.php">
                <button type="submit" class="btn btn-danger mt-3" name="delete_account">Delete Account</button>
            </form>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="shopping-cart-window" class="modal fade" tabindex="-1" aria-labelledby="shoppingCartLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shoppingCartLabel">Reservations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <div class="shopping-cart-content">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        $userId = $_SESSION['user_id'];
                        $reservations = Reservation::getReservationByUserId($userId);
                        if ($reservations) {
                            foreach ($reservations as $reservation) {
                                $bookingId = $reservation['bookingId'];
                                $bookingInfo = Booking::getBookingById($bookingId); 
                                if ($bookingInfo) {
                    ?>
                    <div class='booking-info'>
                        <img src='../uploads/<?php echo $bookingInfo['photo']; ?>' alt='Booking Photo' style='max-width: 100%; height: auto;'>
                        <h3><?php echo $bookingInfo['name']; ?></h3>
                        <p><?php echo $bookingInfo['description']; ?></p>
                        <p>Price: <?php echo $bookingInfo['price']; ?></p>
                        <p>Date: <?php echo $bookingInfo['date']; ?></p>
                        <button class='btn btn-danger cancel-reservation' data-booking-id='<?php echo $bookingId; ?>' data-action="cancel">Cancel Reservation</button>
                    </div>
                    <?php
                                } else {
                                    echo "No booking information available.";
                                }
                            }
                        } else {
                            echo "No reservations.";
                        }
                    } else {
                        echo "Please log in to view reservations.";
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $(document).on('click', '.cancel-reservation', function() {
        var bookingId = $(this).data('booking-id');
        var action = $(this).data('action'); 
        
      
        if (action === 'cancel') {
           
            $.ajax({
                type: 'POST',
                url: '../controller/cancelReservationController.php', 
                data: {
                    bookingId: bookingId
                },
                dataType: 'json',
                success: function(response) {
                    
                    if (response.success) {
                        
                        alert(response.message);
                       
                        location.reload();
                    } else {
                       
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                
                    console.error(status + ': ' + error);
                }
            });
        }
    });
});



</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#updateUserBtn').click(function() {
        var formData = new FormData($('#updateUserForm')[0]);

        $.ajax({
            type: 'POST',
            url: '../controller/updateUser.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message); 
                    
                } else {
                    alert(response.message); 
                }
            },
            error: function(xhr, status, error) {
                console.error(status + ': ' + error); 
                alert('Error updating user information. Please try again.');
            }
        });
    });
});


</script>














<button id="chatbot-button" class="btn btn-primary">Chat with Bot</button>

<div id="chatbot-window" class="chatbot-window">
    <div id="chatbot-messages" class="chatbot-messages"></div>
    <div class="user-input-container">
        <input type="text" id="user-input" class="user-input" placeholder="Type a message...">
        <button id="send-button" class="send-button">Send</button>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatbotButton = document.getElementById('chatbot-button');
        const chatbotWindow = document.getElementById('chatbot-window');
        const userInput = document.getElementById('user-input');
        const sendButton = document.getElementById('send-button');
        const chatbotMessages = document.getElementById('chatbot-messages');
        appendChatbotMessage('Hi! I\'m the Zaytuna Bot . I\'m here to chat with you and give you some advice 😊.');

        let isOpen = false;

        chatbotButton.addEventListener('click', function() {
            isOpen = !isOpen;
            chatbotWindow.style.display = isOpen ? 'block' : 'none';
            chatbotButton.innerText = isOpen ? 'Close Chat' : 'Chat with Bot';

            
          
        });

        sendButton.addEventListener('click', function() {
            const userMessage = userInput.value.trim();
            if (userMessage !== '') {
                appendUserMessage(userMessage);
                userInput.value = '';

              
                if (isSpecifiedMessage(userMessage)) {
                    handleSpecifiedMessage(userMessage);
                } else {
                    sendMessageToBot(userMessage);
                }
            }
        });

        async function sendMessageToBot(message) {
            const modifiedMessage = message + " Tunisia";
            const API_URL = `https://api.adviceslip.com/advice/search/${message}`;
            try {
                const response = await axios.get(API_URL);
                if (response.data.total_results > 0) {
                    const randomIndex = Math.floor(Math.random() * response.data.slips.length);
                    const advice = response.data.slips[randomIndex].advice;
                    appendChatbotMessage(advice);
                } else {
                    appendChatbotMessage('Sorry, I could not find any advice related to your message.');
                }
            } catch (error) {
                console.error('Error sending message to bot:', error);
                appendChatbotMessage('Error: Failed to get advice from the API.');
            }
        }

        function appendUserMessage(message) {
            const messageElement = document.createElement('div');
            messageElement.className = 'user-message';
            messageElement.innerText = message;
            chatbotMessages.appendChild(messageElement);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }

        function appendChatbotMessage(message) {
            const messageElement = document.createElement('div');
            messageElement.className = 'chatbot-message';
            messageElement.innerText = message;
            chatbotMessages.appendChild(messageElement);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }

        
        function isSpecifiedMessage(message) {
            const specifiedMessages = ['hi', 'how are you', 'who are you'];
            return specifiedMessages.includes(message.toLowerCase());
        }

        
        function handleSpecifiedMessage(message) {
            switch (message.toLowerCase()) {
                case 'hi':
                    appendChatbotMessage('Hello! ');
                    break;
                case 'how are you':
                    appendChatbotMessage('I\'m just a bot, but thanks for asking!');
                    break;
                case 'who are you':
                    appendChatbotMessage('I\'m a bot created by the Penguins team 🐧 to make your experience in Zaytuna more fun! 😊');
                    break;
                default:
                    break;
            }
        }
    });
</script>










    <script>
        
        window.addEventListener('load', function() {
            document.getElementById('loading-screen').style.display = 'none';

        });
    </script>

    
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    
    <script src="../assets/js/main.js"></script>
</body>

</html>
