<?php
/* Beskrivelse av filen*/

// Filbane til JSON-filen som inneholder romdata
$filbane = 'rom_data.json';

// Funksjon for å lese romdata fra filen
function lesRomData($filbane) {
    if (file_exists($filbane)) {
        $data = file_get_contents($filbane);
        return json_decode($data, true); // Returner som en assosiativ array
    } else {
        return []; // Returner en tom array hvis filen ikke finnes
    }
}

// Funksjon for å skrive oppdaterte romdata til filen
function skrivRomData($filbane, $romdata) {
    $data = json_encode($romdata, JSON_PRETTY_PRINT);
    file_put_contents($filbane, $data);
}

// Lese eksisterende romdata fra filen
$rom = lesRomData($filbane);

// Standard passord for å tillate redigering
$korrrekt_passord = '1234';
$kan_redigere = false; // Gjør at du ikke kan redigere om det er default

// Sjekk om skjemaet er sendt inn
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sjekk om passordet er sendt inn
    if (isset($_POST['passord'])) {
        // Sjekk om passordet er korrekt
        if ($_POST['passord'] === $korrrekt_passord) {
            $kan_redigere = true; // Tillat redigering hvis passordet er riktig

            // Håndter oppdateringene av rommene (bare status skal kunne endres)
            if (isset($_POST['status'])) {
                foreach ($rom as $index => $r) {
                    // Sjekk at status-verdien eksisterer før den oppdateres
                    if (isset($_POST['status'][$index])) {
                        $rom[$index]['Status'] = $_POST['status'][$index];
                    }
                }
                // Lagre de oppdaterte rommene tilbake til filen
                skrivRomData($filbane, $rom);
                echo "<p style='color:green;'>Oppdateringer er lagret!</p>";
            }
        } else {
            // Feil passord
            echo "<p style='color:red;'>Feil passord. Du kan kun se rommene.</p>";
        }
    }

    // Sjekk om "Logg ut"-knappen er trykket
    if (isset($_POST['logout'])) {
        $kan_redigere = false; // Deaktiver redigering
        // Ingen lagring eller oppdatering, bare gå tilbake til tabellen
    }
}

// Del opp romdataene i to etasjer
$rom_1_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) < 200);
$rom_2_etasje = array_filter($rom, fn($r) => intval($r['Romnummer']) >= 200);

// Skriver ut skjemaet
echo "<form method='post' action=''>";
echo "<p>Skriv inn passord for å redigere rommene: <input type='password' name='passord' placeholder='Passord'></p>";
echo "<div style='display: flex; gap: 20px;'>";

// Funksjon for å skrive ut en tabell basert på etasjen
function skrivUtTabell($romEtasje, $kan_redigere, $etasjenavn) {
    echo "<div>";
    echo "<h3>$etasjenavn</h3>";
    echo "<table border='1'>";

    // Dynamisk generering av tabelloverskrifter (fra nøklene til første element)
    if (!empty($romEtasje)) { // sjekker om romEtasje ikke er tom
        echo "<tr>";
        foreach (array_keys(reset($romEtasje)) as $header) {
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr>";

        // Generer tabellrader for både redigerbar og ikke redigerbar
        foreach ($romEtasje as $index => $r) {
            echo "<tr>";
            // Vis romnummer og type som ikke-redigerbare tekstfelt
            echo "<td>" . htmlspecialchars($r['Romnummer']) . "</td>";
            echo "<td>" . htmlspecialchars($r['Type']) . "</td>";

            if ($kan_redigere) {
                // Bare status kan redigeres hvis passordet er riktig
                echo "<td>
                        <select name='status[$index]'>
                            <option value='Ledig'" . ($r['Status'] == 'Ledig' ? ' selected' : '') . ">Ledig</option>
                            <option value='Opptatt'" . ($r['Status'] == 'Opptatt' ? ' selected' : '') . ">Opptatt</option>
                        </select>
                      </td>";
            } else {
                // Viser status som tekst dersom passord er feil eller ingen passord
                echo "<td>" . htmlspecialchars($r['Status']) . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<p>Ingen romdata tilgjengelig.</p>";
    }
    echo "</table>";
    echo "</div>";
}

// Skriv ut tabellene for hver etasje
skrivUtTabell($rom_1_etasje, $kan_redigere, "Første Etasje");
skrivUtTabell($rom_2_etasje, $kan_redigere, "Andre Etasje");

// Viser oppdatering knapp om passordet er riktig
if ($kan_redigere) {
    echo "<input type='submit' value='Oppdater & Logg ut' name='logout'>"; // Legger til logg ut knapp
}
echo "</form>";
echo "</div>";
?>
