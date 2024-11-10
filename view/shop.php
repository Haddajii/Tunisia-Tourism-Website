<?php
   include("header.php");
   include_once "../model/shop.php";
   include_once "../model/order.php" ;
 // Start the session

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id']; // Get the user ID from the session
  $orders = Order::getOrdersByUserId($userId); // Get orders by user ID
}

   $shops = Shop::getAllShops();
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
#shop {
    padding: 80px 0;
  }

  .shop-card {
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 0.5s ease, transform 0.5s ease;
  }

  .shop-card.show {
    opacity: 1;
    transform: translateY(0);
  }

  .shop-card .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .shop-card .card-img-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 250px;
    object-fit: cover;
  }

  .shop-card .card-body {
    padding: 20px;
  }

  .shop-card .card-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .shop-card .card-text {
    font-size: 16px;
    color: #666;
    margin-bottom: 15px;
  }

  .shop-card .btn-buy {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .shop-card .btn-buy:hover {
    background-color: #45a049;
  }

  /* Shopping Cart Icon Styles */
  .shopping-cart-icon {
    position: fixed;
    bottom: 20px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
    z-index: 1000;
  }

  .shopping-cart-icon .badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 4px 8px;
  }
</style>


</head>
<body>
  <!-- Hero Section -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" >
       
        <div class="carousel-inner" role="listbox">
        <div class="carousel-item active" style="background-image: url(../assets/img/slide/shop.jpg);">
          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Our Shop</h2>
                <p class="animate__animated animate__fadeInUp">Welcome to our modern and stylish shop. Explore our collection of high-quality products.</p>
                <a href="#shop" class="btn-get-started animate__animated animate__fadeInUp scrollto">Explore Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Shop Section -->
  <!-- Shop Section -->
  <section id="shop" class="section-with-bg">
  <div class="container" data-aos="fade-up">
    <div class="section-header">
      <h2>Our Shop</h2>
    </div>
    <div class="row">
      <?php foreach ($shops as $index => $shop): ?>
        <div class="col-lg-3 col-md-6">
          <div class="shop-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
            <div class="card">
              <img src="../uploads/<?php echo $shop['photo']; ?>" class="card-img-top" alt="Shop Photo">
              <div class="card-body">
                <h5 class="card-title"><?php echo $shop['name']; ?></h5>
                <p class="card-text">Price: <?php echo $shop['price']; ?> €</p>
                
                <div class="input-group mb-3">
                  <input type="number" class="form-control quantity-input" id="quantity-input-<?php echo $shop['id']; ?>" placeholder="Quantity" aria-label="Quantity" value="1" min="1">
                </div>
                <button class="btn btn-buy" data-shop-id="<?php echo $shop['id']; ?>">Buy Now</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- In your HTML file -->
<div class="shopping-cart-icon" id="shoppingCartIcon" data-bs-toggle="modal" data-bs-target="#cartModal">
  <i class="bi bi-cart3"></i>
  <span class="badge" id="cartItemCount">0</span>
</div>

<!-- Cart Modal -->
<div<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
        <div id="cartItems">
          <?php
            
            
            
           
            if ($orders) {
              
              foreach ($orders as $order) {
               
                $shopPhoto = Order::getShopPhotoByShopId($order['shopId']);
                $shopinfo = Order::getShopById($order['shopId'])
          ?>
          <div class="row mb-3">
      
            <div class="col-8">
              <p><strong>Product Name:</strong> <?php echo $order['shopname']; ?></p>
              <p><strong>Quantity:</strong> <?php echo $order['quantity']; ?></p>
              <p><strong>Total:</strong> <?php echo $order['total']; ?> €</p>
            </div>
          </div>
          <?php
              }
            } else {
              
              echo "<p>No orders found.</p>";
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






<script>
$(document).ready(function() {
    $('.btn-buy').click(function() {
        var shopId = $(this).data('shop-id');
        var quantity = parseInt($('#quantity-input-' + shopId).val()); // Get the quantity from the input field
        if (quantity <= 0) {
            alert('Please enter a valid quantity.');
            return;
        }
        $.ajax({
            url: '../controller/addOrderC.php',
            type: 'POST',
            dataType: 'json',
            data: { shopId: shopId, quantity: quantity },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});

</script>




  <!-- Footer -->
  <?php include("footer.html"); ?>

  <!-- Scripts -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <script>
     $(document).ready(function() {
    gsap.utils.toArray('.shop-card').forEach((card, index) => {
      gsap.to(card, { opacity: 1, y: 0, duration: 0.5, delay: index * 0.1 });
    });

    // Initialize cart item count
    var cartItemCount = 0;

    // Add event listener to buy buttons
    $('.btn-buy').click(function() {
        var shopId = $(this).data('shop-id');
        var quantity = parseInt($('#quantity-input-' + shopId).val()); // Get the quantity from the input field
        if (quantity <= 0) {
            alert('Please enter a valid quantity.');
            return;
        }

        // Update cart item count
        cartItemCount += quantity;
        $('#cartItemCount').text(cartItemCount);
    });
  });
  </script>
</body>
</html>
