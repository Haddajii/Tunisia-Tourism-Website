<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="../logo.png" rel="icon">
    <title>Zaytuna </title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="../logo.png" style="width:15vh ; margin-left: 30%;">
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="usersList.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="forum.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Forum</h3>
                </a>
                
                <a href="bookingsList.php">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Bookings</h3>
                </a>
                <a href="shopList.php">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Shop</h3>
                </a>

                <a href="home.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Home Page</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        

   
    <script src="../assets/js/admin.js"></script>
</body>

</html>