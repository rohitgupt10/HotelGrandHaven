<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  
  <?php require('inc/links.php'); ?>
  <title> <?php echo $settings_r['site_title'] ?> - ABOUT</title>

  <style>
    .box:hover{
      border-top-color: #0cccfc !important;
      transform: scale(1.03);
      transition: all 0.3s;
    }
  </style>
  <!-- !important tag is given to override inline css -->
  
</head>
<body class="bg-light">
  
  <?php require('inc/header.php'); ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Room Booking is a platform that connects travelers with hotels and accommodations worldwide.<br>
      Our mission is to simplify the booking process, ensuring a seamless experience for both guests and hosts
    </p>
  </div>

  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h3 class="mb-3">
          Our Story
        </h3>
        <p>
          Hotel Grand Haven was founded with the vision of making travel accessible and convenient for everyone. 
          We believe that finding the perfect place to stay should be easy and enjoyable. Our platform offers a wide range of accommodations, from budget-friendly options to luxury stays, ensuring that every traveler can find their ideal room.
        </p>
      </div>

      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <img src="images/about/partners.jpg" class="w-100">
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">

      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/hotel.svg" width="70px">
          <h4 class="mt-3"> 100+ ROOMS</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/customers.svg" width="70px">
          <h4 class="mt-3"> 200+ CUSTOMERS</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/rating.svg" width="70px">
          <h4 class="mt-3"> 150+ REVIEWS</h4>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/staff.svg" width="70px">
          <h4 class="mt-3"> 200+ STAFFS</h4>
        </div>
      </div>

    </div>
  </div>

  <h3 class="my-5 fw-bold h-font text-center"> MANAGEMENT TEAM</h3>

  <div class="container px-4">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <?php 
         $about_r = selectAll('team_details');
         $path=ABOUT_IMG_PATH;
         while($row = mysqli_fetch_assoc($about_r)){
          echo<<<data
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
              <img src="$path$row[picture]" class="w-100">
              <h5 class="mt-2">$row[name]</h5>
            </div>
          data;
         }
        ?>


      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

 <?php require('inc/footer.php'); ?>

 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints:{
        320:{
          slidesPerView: 1,
        },

        640:{
          slidesPerView: 2,
        },

        768:{
          slidesPerView: 3,
        },

        1024:{
          slidesPerView: 4,
        },
      }
    });
  </script>

</body>
</html>