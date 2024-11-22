<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - CONTACT US</title>
  <?php require('admin/inc/links.php'); ?>
  <link rel="stylesheet" href="admin/css/common.css">
</head>

<body class="bg-light">

<?php require('inc/header.php'); ?> 

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Odio id voluptas, <br>obcaecati ipsa consequuntur quas inventore similique 
        saepe praesentium corrupti!
    </p>
</div>

<div class="container">
    <div class="row">
        <!-- First Column -->
        <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4">
                <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d67367.68287654064!2d8.03148905!3d58.1529776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46380258d5607a5b%3A0xdf0c0d6fc81c58a4!2sKristiansand!5e0!3m2!1sno!2sno!4v1731414685342!5m2!1sno!2sno" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <h5>Address</h5>
                <a href="https://maps.app.goo.gl/ds7RPpAG41cDUJYR8" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                <i class="bi bi-geo-alt-fill"></i> Universitetsveien 25, 4630 Kristiansand   
                </a>

                <h5 class="mt-4">Call Us</h5>
                <a href="tel:+4590033117" class="d-inline-block mb-2 text-decoration-none text-dark">
                  <i class="bi bi-telephone-fill"></i> +4590033117
                </a>
                <br>
                <a href="tel:+4590033117" class="d-inline-block text-decoration-none text-dark">
                  <i class="bi bi-telephone-fill"></i> +4590033117
                </a> 

                <h5 class="mt-4">Email</h5>
                <a href="mailto:tvnhotel@gmail.com" class="d-inline-block mb-2 text-decoration-none text-dark">
                    <i class="bi bi-envelope-fill"></i> ask.tvnhotel@gmail.com
                </a>

                <h5 class="mt-4">Follow us</h5>
                <a href="#" class="d-inline-block text-dark fs-5 me-2">
                    <i class="bi bi-twitter me-1"></i>
                </a>
                <a href="#" class="d-inline-block text-dark fs-5 me-2">
                    <i class="bi bi-facebook me-1"></i>
                </a>
                <a href="#" class="d-inline-block text-dark fs-5">
                    <i class="bi bi-instagram me-1"></i>
                </a>
            </div>
        </div>

        <!-- message Column -->
        <div class="col-lg-6 col-md-6 px-4">
            <div class="bg-white rounded shadow p-4">
    
                <h5>Send Us a Message</h5>
                <form>
                    <div class="mt-3">
                        <label class="form-label" style="font-weight: 500;">Name</label>
                        <input type="text" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500;">Email</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500;">Subject</label>
                        <input type="text" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500;" >Message</label>
                        <textarea class="form-control shadow-none" rows="5" style= "resize: none;"></textarea>
                    </div>
                    <button type="submit" class="btn text-white custom-bg mt-3">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('admin/inc/footer.php'); ?>

</body>
</html>
