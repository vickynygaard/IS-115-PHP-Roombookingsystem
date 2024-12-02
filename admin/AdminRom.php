<?php
require('inc/essentials.php');
adminLogin();


$filbane = 'rom_data.json';

// Function to read data from JSON file
function lesRomData($filbane) {
    if (file_exists($filbane)) {
        $data = file_get_contents($filbane);
        return json_decode($data, true);
    } else {
        return [];
    }
}


function skrivRomData($filbane, $romdata) {
    $data = json_encode($romdata, JSON_PRETTY_PRINT);
    file_put_contents($filbane, $data);
}


$rom = lesRomData($filbane);

// Default settings
$kan_redigere = true; 
$prompt = "Du redigerer"; 

//Update handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle room updates when in edit mode
    if ($kan_redigere) {
        if (isset($_POST['status'])) {
            foreach ($_POST['status'] as $index => $status) {
                // If status is changed to 'Ledig', clear the booking info
                if ($status === 'Ledig') {
                    $rom[$index]['BookingInfo'] = 'N/A';
                } else {
                    // If the room is being booked (status is 'Opptatt'), update the booking info
                    if (isset($_POST['checkin_date'][$index]) && isset($_POST['checkout_date'][$index])) {
                        $rom[$index]['BookingInfo'] = [
                            'Start_Date' => $_POST['checkin_date'][$index],
                            'End_Date' => $_POST['checkout_date'][$index],
                            'Booking_Time' => $_POST['booking_time'][$index] ?? 'N/A' 
                        ];
                    }
                }

                $rom[$index]['Status'] = $status;
            }
            // Save the updated data to the JSON file
            skrivRomData($filbane, $rom);
            $prompt = "Endringer er lagret!";
        }
    }
}

$rom_1_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) < 200);
$rom_2_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) >= 200 && intval($r['Rom-ID']) < 300);
$rom_3_etasje = array_filter($rom, fn($r) => intval($r['Rom-ID']) >= 300);

// Function to display a table for a specific floor
function skrivUtTabell($romEtasje, $kan_redigere, $etasjenavn) {
    echo "<div>";
    echo "<h3>$etasjenavn</h3>";
    echo "<div class='table-container'>";
    echo "<table border='1' style='width: 100%;'>";

    if (!empty($romEtasje)) {
        echo "<tr>";
        echo "<th style='padding: 10px;'>Rom-ID</th>";
        echo "<th style='padding: 10px;'>Type</th>";
        echo "<th style='padding: 10px;'>Adults</th>";
        echo "<th style='padding: 10px;'>Children</th>";
        echo "<th style='padding: 10px;'>Status</th>";
        echo "<th style='padding: 10px;'>Booking Info</th>";
        echo "</tr>";

        foreach ($romEtasje as $index => $r) {
            echo "<tr>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Rom-ID']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Type']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Adults']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Children']) . "</td>";

            if ($kan_redigere) {
                // Editable status dropdown for editing
                echo "<td style='padding: 10px;'>
                        <select name='status[$index]'>
                            <option value='Ledig'" . ($r['Status'] == 'Ledig' ? ' selected' : '') . ">Ledig</option>
                            <option value='Opptatt'" . ($r['Status'] == 'Opptatt' ? ' selected' : '') . ">Opptatt</option>
                        </select>
                      </td>";

                // Check-in and Check-out date inputs
                echo "<td style='padding: 10px;'>
                        <label for='checkin_date[$index]'>Check-in</label>
                        <input type='date' name='checkin_date[$index]' value='" . 
                            (isset($r['BookingInfo']['Start_Date']) ? $r['BookingInfo']['Start_Date'] : '') . "'>
                      </td>";

                echo "<td style='padding: 10px;'>
                        <label for='checkout_date[$index]'>Check-out</label>
                        <input type='date' name='checkout_date[$index]' value='" . 
                            (isset($r['BookingInfo']['End_Date']) ? $r['BookingInfo']['End_Date'] : '') . "'>
                      </td>";

                //booking time field
                echo "<td style='padding: 10px;'>
                        <input type='time' name='booking_time[$index]' value='" . 
                            (isset($r['BookingInfo']['Booking_Time']) ? $r['BookingInfo']['Booking_Time'] : '') . "'>
                      </td>";
            } else {
                // If room is not editable, show status and booking info
                $booking_info = isset($r['BookingInfo']) ? $r['BookingInfo'] : 'N/A';
                echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Status']) . "</td>";
                echo "<td style='padding: 10px;'>" . (is_array($booking_info) ? 
                        "Fra: {$booking_info['Start_Date']} til {$booking_info['End_Date']} Kl: {$booking_info['Booking_Time']}" : 'N/A') . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' style='text-align:center;'>Ingen rom tilgjengelig</td></tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
    <style>
        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <form method="POST">
                <p><?php echo $prompt; ?></p>

                <?php
                if ($kan_redigere) {
                    echo "<input type='submit' name='update' value='Update' class='btn btn-primary'>";
                }
                ?>

                <?php

                skrivUtTabell($rom_1_etasje, $kan_redigere, '1. Etasje');
                skrivUtTabell($rom_2_etasje, $kan_redigere, '2. Etasje');
                skrivUtTabell($rom_3_etasje, $kan_redigere, '3. Etasje');
                ?>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
</body>
</html>