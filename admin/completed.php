<?php
session_start();

// Check if booking exists in session
if (!isset($_SESSION['booking'])) {
    header("Location: simple.php");
    exit;
}

$booking = $_SESSION['booking'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Complete</title>
    <?php require('admin/inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container my-5">
    <div class="card text-center border-0 shadow">
        <div class="card-body">
            <h1 class="fw-bold text-success">Booking Confirmed!</h1>
            <p class="lead">Thank you for booking with us.</p>
            <p>Room Number: <strong><?= htmlspecialchars($booking['room_number']); ?></strong></p>
            <p>Start Date: <strong><?= htmlspecialchars($booking['start_date']); ?></strong></p>
            <p>End Date: <strong><?= htmlspecialchars($booking['end_date']); ?></strong></p>
            <a href="simple.php" class="btn btn-outline-dark mt-3">Back to Home</a>
        </div>
    </div>
</div>

<?php require('admin/inc/footer.php'); ?>

</body>
</html>
