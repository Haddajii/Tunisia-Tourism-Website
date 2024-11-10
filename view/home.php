<?php
   include("header.php");
   include_once "../model/booking.php";

   $bookings = Booking::getAllBookings();
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
    
        .unavailable {
        background-color: #eee;
    }

    .unavailable .card-body {
        opacity: 0.5;
    }

    .unavailable .book-now-btn {
        display: none;
    }

    .unavailable .unavailable-text {
        color: red;
        font-weight: bold;
    }


    .booking-card {
    display: block;
    transform: translateY(20px); /* Initial position for animation */
    transition: opacity 0.5s ease, transform 0.5s ease; /* Smooth transition */
}


    .card {
        margin-bottom: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-title {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
    }
    .card-text {
        font-size: 1.1em;
        color: #666;
        margin-bottom: 15px;
    }

    /* Custom button styles */
    .book-now-btn {
        background-color: #5c9f24; /* Base green color */
        border: none;
        border-radius: 25px; /* Adjust the border radius as needed */
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .book-now-btn:hover {
        background-color: #4b8620; /* Darker green color on hover */
    }
</style>


</head>
<body>
      
     <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(../assets/img/slide/2.png);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Sidi Bou Said</h2>
                <p class="animate__animated animate__fadeInUp">The tradition of painting houses in Sidi Bou Said with white and blue colors dates back to the 18th century.</p>
                <div>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                </div>
              </div>
            </div>
          </div> 

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url(../assets/img/slide/14.png);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
                <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                <div>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url(../assets/img/slide/17.png);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                <div>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->



<!-- ======= About Section ======= -->
<section id="about" class="about">
  <div class="container">

    <div class="row no-gutters">
      <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
      <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
        <div class="content d-flex flex-column justify-content-center">
          <h3>Your new destination is right around the corner </h3>
          <p>
          Tunisia is a country located in the north of Africa with over 12 million people, it is often known by locals as Tounes al Khadhra or the Green Tunisia. Here are some cool facts about our country!
          </p>
          <div class="row">
            <div class="col-md-6 icon-box">
              <i class="bx bx-receipt"></i>
              <h4>Over 3000 years of civilization</h4>
              <p>Tunisia has one of the deepest cultures in North Africa</p>
            </div>
            <div class="col-md-6 icon-box">
              <i class="bx bx-cube-alt"></i>
              <h4>Every possible biome</h4>
              <p>With its natural landscape, Tunisia offers sea, snow, desert, mountain, and forest all in one country </p>
            </div>
            <div class="col-md-6 icon-box">
              <i class="bx bx-images"></i>
              <h4>A multilingual people</h4>
              <p>Tunisians take Arabic, French and English classes as part of their mandatory curriculum</p>
            </div>
            <div class="col-md-6 icon-box">
              <i class="bx bx-shield"></i>
              <h4>Deep rooted art and culture</h4>
              <p>Tunisia has preserved the art of the mosaic, one of the oldest forms of collage</p>
            </div>
          </div>
        </div><!-- End .content-->
      </div>
    </div>

  </div>
</section><!-- End About Section -->

<!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
  <div class="container">

    <div class="row no-gutters">

      <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
        <div class="count-box">
          <i class="bi bi-emoji-smile"></i>
          <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
          <p><strong>Happy Clients</strong> have joined us in our journey</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
        <div class="count-box">
          <i class="bi bi-journal-richtext"></i>
          <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
          <p><strong>Great reviews</strong> on our website</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
        <div class="count-box">
          <i class="bi bi-headset"></i>
          <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
          <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
        <div class="count-box">
          <i class="bi bi-people"></i>
          <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
          <p><strong>Hard Workers</strong> rerum asperiores dolor</p>
        </div>
      </div>

    </div>

  </div>
</section><!-- End Counts Section -->

<!-- ======= Clients Section ======= -->
<section id="clients" class="clients section-bg">
  <div class="container">

    <div class="row">

      <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
        <img src="../assets/img/clients/zaytuna.png" class="img-fluid" alt="">
      </div>

      <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
        <img src="../assets/img/clients/tunisair.png" class="img-fluid" alt="">
      </div>

      <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
        <img src="../assets/img/clients/Mosaique.png" class="img-fluid" alt="">
      </div>

      <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
        <img src="../assets/img/clients/Nouvelair.png" class="img-fluid" alt="">
      </div>

      <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
        <img src="../assets/img/clients/Tayara.png" class="img-fluid" alt="">
      </div>

     

    </div>

  </div>
</section><!-- End Clients Section -->



<!-- ======= Why Us Section ======= -->
<section id="why-us" class="why-us">
  <div class="container">

    <div class="section-title">
      <h2>Why Tunisia</h2>
      <p>Nestled in the heart of North Africa, Tunisia beckons with its rich history, vibrant culture, and breathtaking landscapes.</p>
    </div>

    <div class="row">

      <div class="col-lg-4">
        <div class="box">
          <span>01</span>
          <h4>Ancient Charms Await: Explore Tunisia's Enchanting Traditions</h4>
          <p>Immerse yourself in centuries-old traditions, from the enchanting architecture of ancient cities to the bustling souks filled with exotic spices and handcrafted treasures.</p>
        </div>
      </div>

      <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="box">
          <span>02</span>
          <h4>Sunny Delights: Tunisia's Perfect Climate</h4>
          <p>"Explore Tunisia's Ideal Climate, with over 300 sunny days annually. From mild winters to warm summers, it's perfect for outdoor adventures and beach relaxation. </p>
        </div>
      </div>

      <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="box">
          <span>03</span>
          <h4> "Diverse Landscapes, Infinite Adventures</h4>
          <p>"Explore the diverse landscapes, from the golden sands of the Sahara Desert to the lush oases and verdant mountains, providing endless opportunities for adventure and exploration.</p>
        </div>
      </div>

    </div>

  </div>
</section><!-- End Why Us Section -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
  <div class="container">

    <div class="section-title">
      <h2>Discover</h2>
      <p>A new adventure awaits! Let your heart guide you between the beauties of Tunisia! Duny sands, clear waters, lush forests or rustic mountains: which will you let tempt you?</p>
    </div>

    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">North</li>
          <li data-filter=".filter-card">Center</li>
          <li data-filter=".filter-web">South</li>
        </ul>
      </div>
    </div>

    <div class="row portfolio-container">

      <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/1.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>App 1</h4>
            <p>App</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/7.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/3.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>App 2</h4>
            <p>App</p>
            <div class="portfolio-links">
              <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/4.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Card 2</h4>
            <p>Card</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/11.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Web 2</h4>
            <p>Web</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/14.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>App 3</h4>
            <p>App</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/9.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Card 1</h4>
            <p>Card</p>
            <div class="portfolio-links">
              <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/6.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Card 3</h4>
            <p>Card</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <div class="portfolio-wrap">
          <img src="../assets/img/slide/17.png" class="img-fluid" alt="">
          <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <div class="portfolio-links">
              <a href="../assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
<div class="container" id="bookingContainer">
    <div class="section-title">
        <h2>Bookings</h2>
    </div>
    <div class="row" id="bookingRow">
    <?php foreach ($bookings as $booking): ?>
        <?php
            $isUnavailable = ($booking['number'] == 0 || strtotime($booking['date']) < strtotime('today'));
        ?>
        <div class="col-md-4 booking-card">
            <div class="card <?php echo ($isUnavailable) ? 'unavailable' : ''; ?>">
                <img src="../uploads/<?php echo $booking['photo']; ?>" class="card-img-top" alt="<?php echo $booking['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $booking['name']; ?></h5>
                    <p class="card-text"><?php echo $booking['description']; ?></p>
                    <p class="card-text">Price: €<?php echo $booking['price']; ?></p>
                    <p class="card-text">Date: <?php echo $booking['date']; ?></p>
                    <?php if (!$isUnavailable): ?>
                        <button class="book-now-btn" data-booking-id="<?php echo $booking['id']; ?>">Book Now</button>
                    <?php else: ?>
                        <p class="unavailable-text">No longer available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>


    <script>
    $(document).ready(function(){
        
        gsap.registerPlugin(ScrollTrigger);

        
        $(".booking-card").each(function(index, card) {
            
            gsap.set(card, { opacity: 0, y: 50 });

            
            var tl = gsap.timeline({
                scrollTrigger: {
                    trigger: card,
                    start: "top 80%", 
                    end: "bottom top",
                    scrub: true 
                }
            });

           
            tl.to(card, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power4.out"
            });
        });
    });
</script>






<script>
    $(document).ready(function() {
       
        $('.book-now-btn').click(function() {
          
            var bookingId = $(this).data('booking-id');

           
            $.ajax({
                url: '../controller/addReservationC.php',
                type: 'POST',
                dataType: 'json',
                data: { bookingId: bookingId },
                success: function(response) {
                    if (response.success) {
                        alert(response.message); 
                    } else {
                        alert(response.message); 
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + xhr.responseText);
                    alert('Error: ' + xhr.responseText); 
                }
            });
        });
    });
</script>

</script>










    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>
</html>

<?php
   include("footer.html");
?>