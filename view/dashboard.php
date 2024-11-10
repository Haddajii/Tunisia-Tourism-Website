<?php
   include("dashbSides.php");

   include_once "../model/user.php";
   include_once "../model/reservation.php";

   $pdo = config::getConnexion();

   // Instantiate the User class
   $user = new User();
   
   // Call the getLastThreeUsers() method and pass the PDO instance
   $lastThreeUsers = User::getLastThreeUsers($pdo) ;
   $reservations = Reservation::getLastThreeReservations();

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Document</title>

    <style>
        .add-admin-form {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: var(--color-white);
    padding: var(--card-padding);
    border-radius: var(--card-border-radius);
    box-shadow: var(--box-shadow);
    z-index: 9999;
}

.add-admin-form h2 {
    margin-top: 0;
    font-size: 1.4rem;
    color: var(--color-dark);
}

.add-admin-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: var(--color-dark);
}

.add-admin-form input[type="text"],
.add-admin-form input[type="email"],
.add-admin-form input[type="file"],
.add-admin-form input[type="password"] {
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--color-info-dark);
    border-radius: var(--border-radius-1);
    box-sizing: border-box;
}

.add-admin-form input[type="submit"] {
    background-color: var(--color-primary);
    color: var(--color-white);
    padding: 1rem 2rem;
    border: none;
    border-radius: var(--border-radius-1);
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-admin-form input[type="submit"]:hover {
    background-color: #5a81b5;
}

.add-admin-form input[type="file"] {
    cursor: pointer;
}

.add-admin-form .close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    cursor: pointer;
    font-size: 1.4rem;
    color: var(--color-dark);
}

/* Add Shop Form Styles */
.add-shop-form.admin-form {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: var(--color-white);
    padding: var(--card-padding);
    border-radius: var(--card-border-radius);
    box-shadow: var(--box-shadow);
    z-index: 9999;
}

.add-shop-form.admin-form h2 {
    margin-top: 0;
    font-size: 1.4rem;
    color: var(--color-dark);
}

.add-shop-form.admin-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: var(--color-dark);
}

.add-shop-form.admin-form input[type="text"],
.add-shop-form.admin-form input[type="number"],
.add-shop-form.admin-form input[type="file"] {
    width: 100%;
    padding: 0.8rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--color-info-dark);
    border-radius: var(--border-radius-1);
    box-sizing: border-box;
}

.add-shop-form.admin-form input[type="submit"] {
    background-color: var(--color-primary);
    color: var(--color-white);
    padding: 1rem 2rem;
    border: none;
    border-radius: var(--border-radius-1);
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-shop-form.admin-form input[type="submit"]:hover {
    background-color: #5a81b5;
}

.add-shop-form.admin-form input[type="file"] {
    cursor: pointer;
}

    </style>
</head>
<body>
<!-- Main Content -->
<main>
            <h1>Dashboard</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Total Sales</h3>
                            <h1>$65,024</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Site Visit</h3>
                            <h1>24,981</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>-48%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Searches</h3>
                            <h1>14,147</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users">
            <h2>New Users</h2>
            <div class="user-list">
                <?php foreach ($lastThreeUsers as $user): ?>
                    <div class="user">
                        <img src="../uploads/<?php echo $user['photo']; ?>">
                        <h2><?php echo $user['username']; ?></h2>
                        <!-- You can add more details about the user here if needed -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders all">
        <h2>Recent Reservations</h2>
        <table>
           
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Booking ID</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reservations): ?>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['id']; ?></td>
                            <td><?php echo $reservation['userId']; ?></td>
                            <td><?php echo $reservation['userName']; ?></td>
                            <td><?php echo $reservation['userEmail']; ?></td>
                            <td><?php echo $reservation['bookingId']; ?></td>
                           
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No reservations found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
           
        </table>
        <a href="bookingsList.php">View more</a>
    </div>

            <!-- End of Recent Orders -->

                <div class="add-booking-form">
                    <h2>Add Booking</h2>
                    <form id="bookingForm" action="../controller/bookingController.php" method="post" enctype="multipart/form-data">

                        <label for="name">Name:</label>
                        <input  type="text" id="name" name="name" required><br><br>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required></textarea><br><br>
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" required><br><br>
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required><br><br>
                        <label for="number">Number:</label> <!-- New input field for number -->
                        <input type="number" id="number" name="number" required><br><br>
                        <label for="photo">Photo:</label>
                        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
                        <input type="submit" value="Submit">
                    </form>
              </div>
              <div class="add-admin-form">
    <h2>Add Admin</h2>
    <form id="adminForm" action="../controller/addadmin.php" method="post" enctype="multipart/form-data">
        <label for="adminUsername">Username:</label>
        <input type="text" id="adminUsername" name="adminUsername" required><br><br>

        <label for="adminEmail">Email:</label>
        <input type="email" id="adminEmail" name="adminEmail" required><br><br>

        <label for="adminPassword">Password:</label>
        <input type="password" id="adminPassword" name="adminPassword" required><br><br>

        <label for="adminPhoto">Photo:</label>
        <input type="file" id="adminPhoto" name="adminPhoto" accept="image/*" required><br><br>

        <input type="submit" value="Add Admin">
    </form>
</div>

    <!-- End of Add Booking Form -->
    <!-- Add Shop Form -->
<!-- Add Shop Form -->
<div class="add-shop-form admin-form">
    <h2>Add Shop</h2>
    <form id="shopForm" action="../controller/shopController.php" method="post" enctype="multipart/form-data">
        <label for="shopName">Name:</label>
        <input type="text" id="shopName" name="shopName" required><br><br>

        <label for="shopPrice">Price:</label>
        <input type="number" id="shopPrice" name="shopPrice" required><br><br>

        <label for="shopPhoto">Photo:</label>
        <input type="file" id="shopPhoto" name="shopPhoto" accept="image/*" required><br><br>

        <input type="submit" value="Add Shop">
    </form>
</div>



        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Reza</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="images/profile-1.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="../logo.png">
                    <h2>Zaytuna</h2>
                    <p>Fullstack Web Developer</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Reminder</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Break</h3>
                            <small class="text_muted">
                                12:00 PM - 13:30 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

           

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Add Booking</h3>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp" id="addShopButton">
                            add
                        </span >
                        <h3>Add to Shop</h3>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp" id="addAdminButton">
                            add
                        </span>
                        <h3>Add Admin</h3>
                    </div>
                </div>

            </div>

        </div>


    </div>
          

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    // Handle form submission
    $('#bookingForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();
        
        // Serialize form data
        var formData = new FormData($(this)[0]);
        
        // Send AJAX request
        $.ajax({
            url: '../controller/bookingController.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                if (response.success) {
                    alert(response.message);
                    // Clear form fields
                    $('#bookingForm')[0].reset();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('Error: ' + error);
            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $('#adminForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '../controller/addadmin.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    // Optionally, you can display a success message here
                } else {
                    alert(response.message);
                    // Optionally, you can display an error message here
                }
                $('#adminForm')[0].reset(); // Clear the form after submission
            },
            error: function(xhr, status, error) {
                console.error('Failed to add admin.');
                // Display an error message
                alert('Failed to add admin.');
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#shopForm').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '../controller/shopController.php',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        // Optionally, you can display a success message here
                        $('#shopForm')[0].reset(); // Clear the form after successful submission
                    } else {
                        alert(response.message);
                        // Optionally, you can display an error message here
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to add shop.');
                    // Display an error message
                    alert('Failed to add shop.');
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addShopButton = document.querySelector("#addShopButton");
        const addShopForm = document.querySelector(".add-shop-form");

        addShopButton.addEventListener("click", function() {
            if (addShopForm.style.display === "none") {
                addShopForm.style.display = "block"; // Display the form
            } else {
                addShopForm.style.display = "none"; // Hide the form
            }
        });
    });
</script>







    <script src="../assets/js/admin.js"></script>
    <script>
    
    document.addEventListener("DOMContentLoaded", function() {
    const addBookingButton = document.querySelector(".add-reminder");
    const addBookingForm = document.querySelector(".add-booking-form");

    addBookingButton.addEventListener("click", function() {
        if (addBookingForm.style.display === "none") {
            addBookingForm.style.display = "block"; // Display the form
        } else {
            addBookingForm.style.display = "none"; // Hide the form
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const addAdminButton = document.querySelector("#addAdminButton");
    const addAdminForm = document.querySelector(".add-admin-form");

    addAdminButton.addEventListener("click", function() {
        if (addAdminForm.style.display === "none") {
            addAdminForm.style.display = "block"; // Display the form
        } else {
            addAdminForm.style.display = "none"; // Hide the form
        }
    });
});

   </script>
       
    

</body>
</html>