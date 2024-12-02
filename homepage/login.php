<?php
require_once '../inc/login_functions.php';
require_once '../admin/inc/db_config.php';

    session_start();

    //Initialize array hvor eventuelle feilmeldinger lagres
    $errors = [];

    //If the user is already signed in
    if (isset($_SESSION['user_email'])) {
        header("Location: guest.php"); //Redirect to another site
        exit;
    }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            //Authenticate_user() checks login credentials - see login_functions.php
            if (authenticate_user($email, $password, $errors)) {
                //If login is successful, start session and redirect
                session_start();
                $_SESSION['user_email'] = $email;  //Stores user-email in session
                $_SESSION['welcome_message'] = "You are signed in as " . $email;
                echo "Successfull login";
                header("Location: guest.php"); exit; //Redirect
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
  <link rel="stylesheet" href="../css/main.css">
</head>
<body class="bg-light">

    <?php require ('navbar.php')?>

  <!-- Login -->
        <form method="POST" action="login.php">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
          <i class="bi bi-person-circle fs-3 me-2 "></i>User Login
    </h5>
        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" name="email" class="form-control shadow-none" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
            <?php if (isset($errors['email'])): ?>
            <span class="error"><?= $errors['email'] ?></span><?php endif; ?>
        </div>
        <div class="mb-4">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control shadow-none">
            <?php if (isset($errors['password'])): ?>
            <span class="error"><?= $errors['password'] ?></span><?php endif; ?>
            <!-- Login error message -->
            <?php if (isset($errors['login'])): ?>
            <span class="error"><?= $errors['login'] ?></span><?php endif; ?>
        </div>
      <div class="d-flex align-items-center justify-content-between mb-2">
        <button type="submit" class="btn btn-dark shadow-none">Login</button>
        <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password </a>
      </div>

        </div>
        </form>

  <!-- Swiper and Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
  </body>
  </html>