<?php
require('inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">

<?php
// JSON filen og filbanen
$filbane = 'rom_data.json';

// Funksjon som lar lesing av matrisen
function lesRomData($filbane) {
    if (file_exists($filbane)) {
        $data = file_get_contents($filbane);
        return json_decode($data, true); // Return as associative array
    } else {
        return []; // Return empty array if file doesn't exist
    }
}

// Funksjon som lar oppdatering
function skrivRomData($filbane, $romdata) {
    $data = json_encode($romdata, JSON_PRETTY_PRINT);
    file_put_contents($filbane, $data);
}

// Leser json filen
$rom = lesRomData($filbane);

// Passord som er satt
$korrrekt_passord = '12345';
// Kan ikke redigere som standard
$kan_redigere = false;

// Skjekker
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Skjekker om passord er skrevet
    if (isset($_POST['passord'])) {
        // Verifiserer passord
        if ($_POST['passord'] === $korrrekt_passord) {
            $kan_redigere = true; // Vis passord er riktig kan endre

            // Funksjom som oppdaterer rommene
            if (isset($_POST['status'])) {
                foreach ($rom as $index => $r) {
                    if (isset($_POST['status'][$index])) {
                        $rom[$index]['Status'] = $_POST['status'][$index];
                    }
                }
                // Oppdaterer filene
                skrivRomData($filbane, $rom);
                echo "<p style='color:green;'>Oppdateringer er lagret!</p>";
            }
        } else {
            echo "<p style='color:red;'>Feil passord. Du kan kun se rommene.</p>";
        }
    }

    // Skjekker vis logut blir trykket
    if (isset($_POST['logout'])) {
        $kan_redigere = false;
    }
}

// Deler opp rommene i etasjer 
$rom_1_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) < 200);
$rom_2_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) >= 200 && intval($r['Romnummer']) < 300);
$rom_3_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) >= 300);

// Function to display a table for a specific floor
function skrivUtTabell($romEtasje, $kan_redigere, $etasjenavn) {
    echo "<div>";
    echo "<h3>$etasjenavn</h3>";
    echo "<table border='1'>";

    if (!empty($romEtasje)) {
        echo "<tr>";
        foreach (array_keys(reset($romEtasje)) as $header) {
            echo "<th style='padding: 10px;'>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr>";

        foreach ($romEtasje as $index => $r) {
            echo "<tr>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Romnummer']) . "</td>";
            echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Type']) . "</td>";
            if ($kan_redigere) {
                echo "<td style='padding: 10px;'>
                        <select name='status[$index]'>
                            <option value='Ledig'" . ($r['Status'] == 'Ledig' ? ' selected' : '') . ">Ledig</option>
                            <option value='Opptatt'" . ($r['Status'] == 'Opptatt' ? ' selected' : '') . ">Opptatt</option>
                        </select>
                      </td>";
            } else {
                echo "<td style='padding: 10px;'>" . htmlspecialchars($r['Status']) . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<p>Ingen romdata tilgjengelig.</p>";
    }
    echo "</table>";
    echo "</div>";
}

// Viser tabellene i et format
echo "<form method='post' action=''>";
echo "<p>Skriv inn passord for å redigere rommene: <input type='password' name='passord' placeholder='Passord'></p>";
echo "<div style='display: flex; gap: 20px;'>";


// Skriver ut tabellene
skrivUtTabell($rom_1_etasje, $kan_redigere, "Første Etasje");
skrivUtTabell($rom_2_etasje, $kan_redigere, "Andre Etasje");
skrivUtTabell($rom_3_etasje, $kan_redigere, "Tredje Etasje");

if ($kan_redigere) {
    echo "<input type='submit' value='Oppdater & Logg ut' name='logout'>";
}
echo "</form>";
echo "</div>";
?>
        </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?>

</body>
</html>
