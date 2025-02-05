<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title> <?php echo $settings_r['site_title'] ?> - PAYMENT STATUS</title>

  <!-- !important tag is given to override inline css i.e border-dark-->
</head>
<body class="bg-light">
  
 <?php require('inc/header.php'); ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-3 px-4">
        <h2 class="fw-bold">PAYMENT STATUS</h2>
      </div>

      <?php 
        $frm_data = filteration($_POST);
      
        if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
          redirect('index.php');
        }

        echo<<<data
          <div class="col-12 px-4">
          <p class="fw-bold alert alert-success">
          <i class="bi bi-check-circle-fill"></i>
          Payment done! Booking Successful.
          <br><br>
          <a href='bookings.php'>Go to Bookings</a>
          </p>
          </div>
        data;

      ?>
      
   </div>
  </div>

 <?php require('inc/footer.php'); ?>


</body>
</html>