<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merienda&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <!-- Egen CSS finnes i CSS folder -->
        <link rel="stylesheet" href="css/main.css">
</head>
<body class="bg-light">

<!-- Swiper Section -->
<div class="container-fluid px-lg-4 mt-4">
  <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide swiper-slide-image">
        <img src="images/hotelbilder/orange.jpeg" class="w-100 d-block"/> 
      </div>
      <div class="swiper-slide swiper-slide-image">
        <img src="images/hotelbilder/sweet.jpeg" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide swiper-slide-image">
        <img src="images/hotelbilder/wood.jpeg" class="w-100 d-block" />
      </div>
      <div class="swiper-slide swiper-slide-image">
        <img src="images/hotelbilder/deilig.jpeg" class="w-100 d-block"/>
      </div>
    </div>

</div>

<!-- Swiper and Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Swiper Initialization Script -->
<script>
  var swiper = new Swiper(".swiper-container", {
    spaceBetween: 30,
    effect: "fade",
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    }
  });

  var swiper = new Swiper(".swiper-testimonials" , {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true, 
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 50,
      stretch: 0, 
      depth: 100,
      modifier: 1, 
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 1,
      },
      1024: {
        slidesPerView: 3,
      },
    }
  });
</script>
           
</body>
</html>