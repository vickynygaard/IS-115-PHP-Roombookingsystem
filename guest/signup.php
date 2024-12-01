<?php
require_once '../inc/input_helpers.php';
require_once '../inc/config.php';

session_start();

//Array hvor eventuelle feilmeldinger lagres
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //clean_input() saniterer feltene
    $fields = [
        'firstname' => clean_input('firstname', $_POST['firstname']),
        'lastname' => clean_input('lastname', $_POST['lastname']),
        'email' => clean_input('email', $_POST['email']),
        'phone' => clean_input('phone', $_POST['phone']),
        'birthday' => clean_input('birthday', $_POST['birthday']),
        'password' => clean_input('password', $_POST['password']),
    ];

    //Spam-bot sjekk
    $honeypot_error = check_honeypot($_POST['honeypot']);
    if ($honeypot_error) {
        $errors['honeypot'] = $honeypot_error;
    }

    //validate_fields validerer feltene
    validate_fields($fields, $errors);

    if (empty($errors)) {
        //Passord hash - se https://www.php.net/manual/en/function.password-hash.php
        //$hashed_password = password_hash($fields['password'], PASSWORD_DEFAULT);

        //LEGG INN KODE FOR Å LAGRE I DATABASE HER

        header();

        //ENDRE TIL MELDING ELLER OMDIREGERE TIL NY SIDE (f.eks login siden)
        echo "Registreringen er vellykket!";
    }
}



?>
<!DOCTYPE html>
<html lang="no">
<head> 
    <title>Login</title>
    <meta charset="UTF-8">
      <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- Egen CSS finnes i CSS folder -->
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<?php require('../html/navbar.php');?>

<div class="container my-5">
  
    <div class="card shadow-lg">
    <div class="card-header text-center">
      <h5 class="modal-title d-flex align-items-center">
        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration
      </h5>
    </div>
    <div class="card-body">
      <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
        Note: Your details must match with your ID (Password, driver's license, etc.)
        that will be required during check-in.
      </span>
      <form method="POST" action="signup.php">
        <div class="container-fluid">
            <h3>Personal details</h3>
          <div class="row">
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">First Name</label>
              <input type="text" name="firstname" class="form-control shadow-none" placeholder="First name">
                <?php if (isset($errors['firstname'])): ?>
                <span class="error"><?= $errors['firstname'] ?></span><?php endif; ?>
            </div>

            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Last Name</label>
              <input type="text" name="lastname" class="form-control shadow-none" placeholder="Last name">
                <?php if (isset($errors['lastname'])): ?>
                <span class="error"><?= $errors['lastname'] ?></span><?php endif; ?>
            </div>
            
            <div class="col-md-12 p-0 mb-3">
              <label class="form label">Email</label>
              <input type="email" name="email" class="form-control shadow-none" placeholder="Email">
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?= $errors['email'] ?></span><?php endif; ?>
            </div>
            
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Phone Number</label>
              <input type="number" name="phone" class="form-control shadow-none" placeholder="Phone Number">
                <?php if (isset($errors['phone'])): ?>
                <span class="error"><?= $errors['phone'] ?></span><?php endif; ?>
            </div>
            
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Date of birth</label>
              <input type="date" name="birthday" class="form-control shadow-none">
                <?php if (isset($errors['birthday'])): ?>
                <span class="error"><?= $errors['birthday'] ?></span><?php endif; ?>
            </div>

            <h3>Password</h3>
            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base" id="requirement_psw">
                Passord må inneholde: minst 8 tegn, og minst en stor bokstav og et siffer
            </span>
            
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Password</label>
              <input type="password" name="password" class="form-control shadow-none">
                <?php if (isset($errors['password'])): ?>
                <span class="error"><?= $errors['password'] ?></span><?php endif; ?>
            </div>
            
            <div class="col-md-6 ps-0 mb-3">
              <label class="form label">Confirm Password</label>
              <input type="password" name="confpassword" class="form-control shadow-none">
                <?php if (isset($errors['password'])): ?>
                <span class="error"><?= $errors['password'] ?></span><?php endif; ?>
            </div>
          </div>
        </div>
                <!--Honeypot-->
        <input type="hidden" name="honeypot" value=""><br>
        <div class="text-center my-1">
          <button type="submit" class="btn btn-dark shadow-none">Sign up</button>
        </div>
      </form>
    </div>
  </div>
</div>


</body>
</html>