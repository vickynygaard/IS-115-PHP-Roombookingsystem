<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merienda&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <style>
    
    * {
      font-family: 'Poppins', sans-serif;
    }
    .h-font {
      font-family: 'Merienda', cursive;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
input[type=number] {
  -moz-appearance: textfield;
}

.custom-bg{
  background-color: #2ec1ac;
}
.custom-bg:hover{
  background-color: #279e8c;
}

.availability-form{
  margin-top: -50px;
  z-index: 2;
  position: relative;
}

@media screen and (max-width: 575px) {
  .availability-form{
  margin-top: 25px;
  padding: 0 35px;
  }
}

.swiper-slide-image {
  height: 900px; /* You can adjust the height as needed */
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Set images to cover the container without stretching */
.swiper-slide-image img {
  height: 100%;
  object-fit: cover; /* Keeps aspect ratio and crops excess parts */
}

  </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">TVN HOTEL</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="rooms.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
      </ul>
<div class="d-flex">

<button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
  Login
  </button>
  <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
  Register
  </button>
</div>
</div>
</div>
</div>
  </nav>

<!-- Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center">
        <i class="bi bi-person-circle fs-3 me-2 "></i>User Login
  </h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control shadow-none">
      </div>
      <div class="mb-4">
    <label class="form-label">Password</label>
    <input type="password" class="form-control shadow-none">
      </div>
    <div class="d-flex align-items-center justify-content-between mb-2">
      <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
      <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password </a>
    </div>

      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center">
          <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration
        </h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
          Note: Your details must match with your ID (Passeword, drivers license, etc.)
          that will be required during check-in.
        </span>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Name</label>
              <input type="text" class="form-control shadow-none">
            </div>
            <div class="col-md-6 p-0 mb-3">
              <label class="form label">Email</label>
              <input type="email" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Phone Number</label>
              <input type="number" class="form-control shadow-none">
            </div>
            <div class="col-md-6 p-0 mb-3">
              <label class="form label">Picture</label>
              <input type="file" class="form-control shadow-none">
            </div>
            <div class="col-md-12 p-0 mb-3">
              <label class="form label">Address</label>
              <textarea class="form-control shadow-none" rows="1"></textarea>
            </div>
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Pincode</label>
              <input type="number" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Date of birth</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Password</label>
              <input type="password" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Confirm Password</label>
              <input type="password" class="form-control shadow-none">
            </div>
            </div>
          </div>
      </div>
      <div class="text-center my-1">
        <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>

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

<!--Check availability form -->
<div class="container availability-form">
  <div class="row">
    <div class="col-lg-12 bg-white shadow p-4 rounded">
      <h5 class="mb-4">Check Booking Availability</h5>
      <form>
        <div class="row align-items-end">
          <div class="col lg-3 mb-3">
            <label class="form-label" style="font-weight:500;">Check-in</label>
            <input type="date" class="form-control shadow-none">
          </div>
          <div class="col lg-3 mb-3">
            <label class="form-label" style="font-weight:500;">Check-out</label>
            <input type="date" class="form-control shadow-none">
          </div>
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight:500;">Adult</label>
            <select class="form-select shadow-none">
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
          </select>
          </div>
          <div class="col-lg-2 mb-3">
            <label class="form-label" style="font-weight:500;">Children</label>
            <select class="form-select shadow-none">
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
          </select>
          </div>
          <div class="col-lg-1 mb-lg-3 mt-2">
            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!---Our Rooms-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/Rooms/img1.jpg" class="card-img-top">
        <div class="card-body">
          <h5>Simple room</h5>
          <h6 class="mb-4">200kr a night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              2 Rooms 
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Bathroom
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Balcony
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              3 Sofa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Television
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
            AC
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Room heater
            </span>

          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light ">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none border">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/Rooms/img1.jpg" class="card-img-top">
        <div class="card-body">
          <h5>Simple room</h5>
          <h6 class="mb-4">200kr a night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              2 Rooms 
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Bathroom
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Balcony
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              3 Sofa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Television
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
            AC
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Room heater
            </span>

          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light ">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none border">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/Rooms/img1.jpg" class="card-img-top">
        <div class="card-body">
          <h5>Simple room</h5>
          <h6 class="mb-4">200kr a night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              2 Rooms 
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Bathroom
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              1 Balcony
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              3 Sofa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Television
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
            AC
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              Room heater
            </span>

          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light ">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none border">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
    </div>
<div class="col-lg-12 text-center mt-5">
  <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
</div>
  </div>
</div>

<!---Our facilities-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>

<div class="container">
  <div class="row justify-content-evenly px-lg-0 px-md-0 px-5"> 
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/Facilities/wifi2.jpg" width="80px">
      <h5 class="mt-3">Wifi</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/Facilities/wifi2.jpg" width="80px">
      <h5 class="mt-3">Wifi</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/Facilities/wifi2.jpg" width="80px">
      <h5 class="mt-3">Wifi</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/Facilities/wifi2.jpg" width="80px">
      <h5 class="mt-3">Wifi</h5>
    </div>
    <dic class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>

    </dic>
  </div>
</div>

<!--Testimonials-->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTEMONIALS</h2>

<div class="container">
  <div class="swiper swiper-testimonials">
    <div class="swiper-wrapper mb-5">

    <div class="swiper-slide bg-white p-4">
      <div class="profile d-flex align-items-center mb-3">
        <i class="bi bi-star-fill star-icon" style="font-size: 30px"></i> 
    <h6 class="m-0 ms-2">Random user1</h6>
  </div>
  <p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    Id nemo excepturi, incidunt qui libero at omnis iure
    magni tempora ea.
  </p>
  <div class="rating">
    <i class="bi bi-star-fill text-warning"></i>
    <i class="bi bi-star-fill text-warning"></i>
    <i class="bi bi-star-fill text-warning"></i>
    <i class="bi bi-star-fill text-warning"></i>
  </div>
</div>
<div class="swiper-slide bg-white p-4">
  <div class="profile d-flex align-items-center mb-3">
    <i class="bi bi-star-fill star-icon" style="font-size: 30px"></i> 
<h6 class="m-0 ms-2">Random user2</h6>
</div>
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit.
Id nemo excepturi, incidunt qui libero at omnis iure
magni tempora ea.
</p>
<div class="rating">
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
</div>
</div>
<div class="swiper-slide bg-white p-4">
  <div class="profile d-flex align-items-center mb-3">
    <i class="bi bi-star-fill star-icon" style="font-size: 30px"></i> 
<h6 class="m-0 ms-2">Random user3</h6>
</div>
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit.
Id nemo excepturi, incidunt qui libero at omnis iure
magni tempora ea.
</p>
<div class="rating">
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
</div>
</div>
<div class="swiper-slide bg-white p-4">
  <div class="profile d-flex align-items-center mb-3">
    <i class="bi bi-star-fill star-icon" style="font-size: 30px"></i> 
<h6 class="m-0 ms-2">Random user4</h6>
</div>
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit.
Id nemo excepturi, incidunt qui libero at omnis iure
magni tempora ea.
</p>
<div class="rating">
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
<i class="bi bi-star-fill text-warning"></i>
</div>
</div>


</div>
    <div class="swiper-pagination"></dic>
  </div>
</div>

<!-- Reach Us -->

<?php
require ('admin/inc/db_config.php');
$contact_q= "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));


?>

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
      <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe'] ?>"></iframe>
    </div>

    <div class="col-lg-4 col-md-4">
      <div class="bg-white p-4 rounded mb-4">
        <h5>Call Us</h5>
        <a href="tel:+<?php echo $contacts_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> <?php echo $contact_r['pn1'] ?>
        </a>
        <br>
        <?php 
        if (isset($contact_r['pn2']) && trim($contact_r['pn2']) != '') {
          echo <<<data
          <a href="tel:+{$contact_r['pn2']}" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i> {$contact_r['pn2']}
          </a>
          data;
      }
      
        ?>
        
      </div>

      <!-- Follow Us Section -->
      <div class="bg-white p-4 rounded mb-4">
        <h5>Follow us</h5>
        <?php
        if($contact_r['tw']!=''){
          echo<<<data
          <a href="$contact_r[tw]" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-twitter me-1"></i>Twitter
              </span>
            </a>
            </br>
          data;
        }
        ?>
        
        <a href="<?php echo $contact_r['fb']?>" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-facebook me-1"></i>Facebook
          </span>
        </a>
        <br>
        <a href="<?php echo $contact_r['insta']?>" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-instagram me-1"></i>Instagram
          </span>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid bg-white mt-5">
<div class="row">
  <div class="col-lg-4 p-4">
    <h3 class="h-font fw-bold fs-3">TVN HOTEL</h3>

</div>
<div class="col-lg-4 p-4">

</div>
<div class="col-lg-4 p-4">
</div>

    
    
</div>
</div>





<br><br><br>
<br><br><br>


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

