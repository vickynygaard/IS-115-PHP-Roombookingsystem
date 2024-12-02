<<<<<<< HEAD
<?php
// Define the path to the JSON file
$rom_data_file = 'Admin/rom_data.json';

// Load JSON data
$rom_data = json_decode(file_get_contents($rom_data_file), true);

// Calculate available rooms
$total_simple_rooms = 10; // Adjust as per your data
$available_simple_rooms = count(array_filter($rom_data, function ($room) {
    return $room['Type'] === 'simple' && $room['Status'] === 'Ledig';
}));

// Update button and availability text
$book_button_disabled = ($available_simple_rooms === 0) ? 'disabled' : '';
$availability_text = ($available_simple_rooms === 0) ? 'No rooms available' : "$available_simple_rooms/$total_simple_rooms rooms available";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel - Simple Room</title>
    <?php require('admin/inc/links.php'); ?>
    <link rel="stylesheet" href="admin/css/common.css">
    <style>
        .navbar {
            background-color: #343a40;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        .hero-section {
            background: url('images/hotelbilder/warm.jpeg') center/cover no-repeat;
            height: 50vh;
            position: relative;
        }

        .hero-overlay {
            background: rgba(0, 0, 0, 0.5);
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-overlay h1 {
            color: white;
            font-size: 3rem;
            font-weight: bold;
        }

        .room-card img {
            height: 200px;
            object-fit: cover;
        }

        .btn-custom {
            background-color: #343a40;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #ffc107;
            color: #343a40;
        }
    </style>
</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="hero-section">
    <div class="hero-overlay">
        <h1>Welcome to the Simple Room</h1>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="fw-bold">Room Features</h2>
            <ul>
                <li>1 Room, 1 Bathroom, 1 Balcony</li>
                <li>1 Sofa, Double/Full Bed</li>
                <li>Elegant Furnishing</li>
            </ul>

            <h3 class="mt-4">Facilities</h3>
            <ul>
                <li>High-speed Wifi</li>
                <li>Television with Premium Channels</li>
                <li>Air Conditioning & Room Heater</li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="card room-card border-0 shadow">
                <img src="images/rooms/img1.jpg" class="card-img-top" alt="Room Image">
                <div class="card-body">
                    <h4 class="card-title">Simple Room</h4>
                    <p class="card-text">2 Adults, 2 Children</p>
                    <h5>2000kr per night</h5>
                    <!-- Availability Text -->
                    <p class="text-muted fw-bold mb-2"><?= $availability_text; ?></p>
                    <!-- Book Now Button -->
                    <form method="POST" action="book_room.php">
                        <input type="hidden" name="room_type" value="simple">
                        <button type="submit" name="book_now" class="btn btn-outline-dark btn-sm w-100 mt-2" <?= $book_button_disabled; ?>>
                            <?= $book_button_disabled ? 'No rooms available' : 'Book Now'; ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('admin/inc/footer.php'); ?>

</body>

</html>
=======
<?php
// Define the path to the JSON file
$rom_data_file = 'Admin/rom_data.json';

// Load JSON data
$rom_data = json_decode(file_get_contents($rom_data_file), true);

// Calculate available rooms
$total_simple_rooms = 10; // Adjust as per your data
$available_simple_rooms = count(array_filter($rom_data, function ($room) {
    return $room['Type'] === 'simple' && $room['Status'] === 'Ledig';
}));

// Update button and availability text
$book_button_disabled = ($available_simple_rooms === 0) ? 'disabled' : '';
$availability_text = ($available_simple_rooms === 0) ? 'No rooms available' : "$available_simple_rooms/$total_simple_rooms rooms available";

// Get current date and time for validation
$currentDate = new DateTime();
$currentDateString = $currentDate->format('Y-m-d'); // For Date Picker
$minBookingTime = $currentDate->add(new DateInterval('PT3H')); // 3 hours ahead
$minBookingTimeString = $minBookingTime->format('H:i'); // For Time Picker
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel - Simple Room</title>
    <?php require('admin/inc/links.php'); ?>
    <link rel="stylesheet" href="admin/css/common.css">
    <style>
        .navbar {
            background-color: #343a40;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        .hero-section {
            background: url('images/hotelbilder/warm.jpeg') center/cover no-repeat;
            height: 50vh;
            position: relative;
        }

        .hero-overlay {
            background: rgba(0, 0, 0, 0.5);
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-overlay h1 {
            color: white;
            font-size: 3rem;
            font-weight: bold;
        }

        .room-card img {
            height: 200px;
            object-fit: cover;
        }

        .btn-custom {
            background-color: #343a40;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #ffc107;
            color: #343a40;
        }
    </style>
</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="hero-section">
    <div class="hero-overlay">
        <h1>Welcome to the Simple Room</h1>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="fw-bold">Room Features</h2>
            <ul>
                <li>1 Room, 1 Bathroom, 1 Balcony</li>
                <li>1 Sofa, Double/Full Bed</li>
                <li>Elegant Furnishing</li>
            </ul>

            <h3 class="mt-4">Facilities</h3>
            <ul>
                <li>High-speed Wifi</li>
                <li>Television with Premium Channels</li>
                <li>Air Conditioning & Room Heater</li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="card room-card border-0 shadow">
                <img src="images/rooms/img1.jpg" class="card-img-top" alt="Room Image">
                <div class="card-body">
                    <h4 class="card-title">Simple Room</h4>
                    <p class="card-text">2 Adults, 2 Children</p>
                    <h5>2000kr per night</h5>
                    <!-- Availability Text -->
                    <p class="text-muted fw-bold mb-2"><?= $availability_text; ?></p>
                    <!-- Book Now Button -->
                    <button id="book-now-btn" class="btn btn-outline-dark btn-sm w-100 mt-2" <?= $book_button_disabled; ?>>
                        <?= $book_button_disabled ? 'No rooms available' : 'Book Now'; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Popup -->
<div id="booking-popup" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 20px; border-radius: 10px;">
        <h3>Select your booking date and time</h3>
        <form action="/mywebsite/process_booking.php" method="POST" onsubmit="hidePopup();">
            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start_date" value="<?= $currentDateString; ?>" required><br><br>

            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="end_date" value="<?= $currentDateString; ?>" required><br><br>

            <label for="booking-time">Booking Time:</label>
            <input type="time" id="booking-time" name="booking_time" value="<?= $minBookingTimeString; ?>" required><br><br>

            <button type="submit" class="btn btn-outline-dark">Confirm Booking</button>
            <button type="button" id="close-popup" class="btn btn-outline-danger">Cancel</button>
        </form>
    </div>
</div>

<?php require('admin/inc/footer.php'); ?>

<script>
// Open booking popup
document.getElementById('book-now-btn').addEventListener('click', function () {
    document.getElementById('booking-popup').style.display = 'flex';
});

// Close the booking popup
document.getElementById('close-popup').addEventListener('click', function () {
    document.getElementById('booking-popup').style.display = 'none';
});

// Prevent booking within 3 hours of the current time
document.getElementById('booking-time').addEventListener('input', function (event) {
    const selectedTime = event.target.value;
    const selectedDateTime = new Date("<?= $currentDateString; ?>T" + selectedTime);

    const minDate = new Date("<?= $minBookingTimeString; ?>");
    if (selectedDateTime < minDate) {
        alert("Booking time must be at least 3 hours ahead of the current time.");
        event.target.value = "<?= $minBookingTimeString; ?>"; // Reset to 3 hours ahead
    }
});

// Hide the popup when the form is submitted
function hidePopup() {
    document.getElementById('booking-popup').style.display = 'none';
}
</script>

</body>
</html>
>>>>>>> 6e3eebbeb78ec9d06aca3df5f4969e27f8156688
