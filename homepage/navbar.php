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
        <link rel="stylesheet" href="../css/main.css">
</head>
<body class="bg-light">

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="../index.php">TVN MOTEL</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active me-2" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-2" href="rooms.php">Rooms</a>
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
                <a class="btn btn-outline-dark shadow-none me-lg-2 me-2" href="http://localhost/MyWebsite/homepage/signup.php">Sign up</a>


                </div>
                </div>
            </div>
        </div>
    </nav>
           
</body>
</html>