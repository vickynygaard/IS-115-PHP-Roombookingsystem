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
