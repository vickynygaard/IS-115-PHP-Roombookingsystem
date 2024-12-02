<?php 

session_start();

    //Check if the user is logged in
    if (!isset($_SESSION['user_email'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit;
    }

    //Handle logout
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php"); //Redirects to login page after logout
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merienda&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <!-- Egen CSS finnes i CSS folder -->
  <link rel="stylesheet" href="../css/yourpage.css">
</head>
<body>
    <div class="container">
    <button class="homepage-btn" onclick="window.location.href='../index.php';">Go to Homepage</button><br><br>
        <div class="welcome-message">
            <?= htmlspecialchars($_SESSION['welcome_message']); ?>!
        </div><br><br>
        <!-- Sign-out button -->
        <form method="POST" action="">
            <button class="logout-btn" type="submit" name="logout">Sign out</button>
        </form>
    </div>
</body>
</html>