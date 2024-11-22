<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - ABOUT</title>

  <?php include 'admin/inc/links.php'; ?>



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  
  <style>
    .box {
      border-top: 4px solid var(--teal) !important;
    }
    .swiper {
      height: 200px; /* Adjust as needed */
    }
  </style>
  <link rel="stylesheet" href="admin/css/common.css">
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>


<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Odio id voluptas, <br>obcaecati ipsa consequuntur quas inventore similique 
        saepe praesentium corrupti!
    </p>
</div>

<div class="container">
    <div class="row justify-content-between align-items-center">
       <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
           <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
               Adipisci vel qui perferendis aperiam consequuntur beatae tenetur?
               Lorem ipsum dolor sit amet consectetur adipisicing elit. 
               Adipisci vel qui perferendis aperiam consequuntur beatae tenetur?
           </p>
       </div> 
       <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
           <img src="" height="200px" width="300px" alt="">
       </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4"> 
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/Facilities/hotel.png" width="130px">
                <h5 class="mt-3">100+ ROOMS</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4"> 
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/About/customers.webp" width="130px">
                <h5 class="mt-3">200+ CUSTOMERS</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4"> 
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/About/customer.png" width="130px">
                <h5 class="mt-3">100+ REVIEWS</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4"> 
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/About/staff.png" width="130px">
                <h5 class="mt-3">200+ STAFFS</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>
</div>

<h3 class="my-5 fw-bold h-font text-center"> MANAGEMENT TEAM </h3>

<div class="container px-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                <img src="images/About/profilbilde.jpg" class="w-100">
                <h5 class="mt-2">Thea Nielsen</h5>
            </div>
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                <img src="images/About/profilbilde.jpg" class="w-100">
                <h5 class="mt-2">Thea Nielsen</h5>
            </div>
            <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                <img src="images/About/profilbilde.jpg" class="w-100">
                <h5 class="mt-2">Thea Nielsen</h5>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<?php require('admin/inc/footer.php'); ?>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        grabCursor: true,
    });
</script>

</body>
</html>
