<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="../logo.png" rel="icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Zaytuna</title>

    <style>
        /* Add this CSS below your existing styles */

.modal-content {
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
}

.modal-header {
    background-color: #006d77;
    color: #fff;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.modal-title {
    font-size: 20px;
    font-weight: 600;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    border-top: none;
    padding: 10px 20px;
    text-align: right;
}

.modal-footer button {
    background-color: #006d77;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.modal-footer button:hover {
    background-color: #00555f;
}

#passwordResetForm .form-control {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 10px 15px;
    margin-bottom: 10px;
    width: 100%;
    font-size: 14px;
}

#passwordResetForm .btn-primary {
    background-color: #006d77;
    border: none;
    border-radius: 8px;
    color: #fff;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

#passwordResetForm .btn-primary:hover {
    background-color: #00555f;
}


    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="registerForm" action="../controller/UserController.php" method="post" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <button class="gsi-material-button">
                        <div class="gsi-material-button-state"></div>
                        <div class="gsi-material-button-content-wrapper">
                          <div class="gsi-material-button-icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                              <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                              <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                              <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                              <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                              <path fill="none" d="M0 0h48v48H0z"></path>
                            </svg>
                          </div>
                          <span class="gsi-material-button-contents">Sign in with Google</span>
                          <span style="display: none;">Sign in with Google</span>
                        </div>
                      </button>
                </div>
                <span>or use email for registration</span>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="file" id="photo" name="photo" accept="image/*">
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        
        <div class="form-container sign-in">
            <form id="loginForm" action="../controller/UserController.php" method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <button class="gsi-material-button">
                        <div class="gsi-material-button-state"></div>
                        <div class="gsi-material-button-content-wrapper">
                          <div class="gsi-material-button-icon">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                              <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                              <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                              <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                              <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                              <path fill="none" d="M0 0h48v48H0z"></path>
                            </svg>
                          </div>
                          <span class="gsi-material-button-contents">Sign in with Google</span>
                          <span style="display: none;">Sign in with Google</span>
                        </div>
                      </button>
                </div>
                <span>or use email and password</span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#" id="forgetPasswordLink" data-bs-toggle="modal" data-bs-target="#passwordResetModal">Forget Your Password?</a><br>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
         <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>

                <div class="toggle-panel toggle-right">
                    <h1>Hello Friend!</h1>
                    <p>Register with  your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
         </div>
    </div>

    <!-- Modal for password reset -->
    <div class="modal fade" id="passwordResetModal" tabindex="-1" aria-labelledby="passwordResetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordResetModalLabel">Password Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordResetForm" action="../controller/sendPasswordResetLink.php" method="post" >
                    <div class="mb-3">
                        <label for="resetEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="resetEmail" name="resetEmail" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="resetPassword" id="resetPasswordBtn">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#forgetPasswordLink').click(function(e) {
        e.preventDefault();
        
        // Open the modal
        $('#passwordResetModal').modal('show');
    });

    $('#sendResetLinkBtn').click(function(e) {
        e.preventDefault();
        
        var email = $('#resetEmail').val(); // Get the email from the input field

        if (email) {
            $.ajax({
                type: "POST",
                url: "../controller/sendPasswordResetLink.php",
                data: { email: email },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        // Close the modal after sending the reset link
                        $('#passwordResetModal').modal('hide');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while sending the password reset link.");
                }
            });
        } else {
            alert("Please provide an email address.");
        }
    });
});

</script>






    

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click',()=>{
            container.classList.add("active");
        });

        loginBtn.addEventListener('click',()=>{
            container.classList.remove("active");
        })
    </script>

<script>
        // Check if there's an error message in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const errorMessage = urlParams.get('error');
        if (errorMessage) {
            // Display an alert with the error message
            alert(errorMessage);
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

</body>
</html>


