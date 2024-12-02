<?php
require_once 'inc/input_helpers.php';
require_once 'inc/config.php';

session_start();

//Initialize array where error messages are stored
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $_SESSION['fields'] = [
    'checkin' => clean_input('checkin', $_POST['checkin']),
    'checkout' => clean_input('checkout', $_POST['checkout']),
  ];

  validate_past_date($_SESSION['fields'], $errors);

    if (empty($errors)) {
      //Redirect til rooms.php if successful validation
      header("Location: homepage/rooms.php");
      exit;
    }
    else {
      echo "error";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motel</title>
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

 <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">TVN MOTEL</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-2" href="http://localhost/MyWebsite/homepage/rooms.php">Rooms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-2" href="http://localhost/MyWebsite/homepage/contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/MyWebsite/homepage/about.php">About</a>
            </li>
            </ul>

            <div class="d-flex">

                <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
                <a class="btn btn-outline-dark shadow-none me-lg-2 me-2" href="http://localhost/MyWebsite/homepage/signup.php">Sign up</a>

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
      <input type="email" name="email" class="form-control shadow-none">
        </div>
        <div class="mb-4">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control shadow-none">
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

  <?php require ('html/swiper.php'); //Swiper section - pictures front page?>

  <!--Check availability form -->
  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking Availability</h5>
        <form method="POST" action="">
          <div class="row align-items-end">
            <div class="col lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Check-in</label>
              <input type="date" name="checkin" class="form-control shadow-none">
                <?php if (isset($errors['checkin'])): ?>
                <span class="error"><?= $errors['checkin'] ?></span><?php endif; ?>
            </div>
            <div class="col lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Check-out</label>
              <input type="date" name="checkout" class="form-control shadow-none">
                <?php if (isset($errors['checkout'])): ?>
                <span class="error"><?= $errors['checkout'] ?></span><?php endif; ?>
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Adults</label>
              <select name="adults" class="form-select shadow-none">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            </select>
            </div>
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight:500;">Children</label>
              <select name="children" class="form-select shadow-none">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            </select>
            </div>
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require('html/ourRooms.php'); //Our Rooms?>
  <?php require('html/reachUs.php'); //Reach Us
        require('html/tvn.php');?>


  <!-- Swiper and Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>
</html>

