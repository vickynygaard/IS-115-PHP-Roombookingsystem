<?php
/**
 * Denne filen lagrer statiske verdier som:
 * - Datoformat
 * - Feilmeldinger
 * - Valideringsregler
 */

 //Datoformat
define('DATE_FORMAT', 'Y-m-d');

//Feilmeldinger
$ERROR_MESSAGES = [
    'required' => "%s er påkrevd, feltet kan ikke være tomt.",
    'fname' => "Vennligst sjekk at fornavn ikke inneholder spesialtegn.",
    'lname' => "Vennligst sjekk at etternavn ikke inneholder spesialtegn.",
    'email' => "Vennligst sjekk at e-post har riktig format - f.eks. bruker@eksempel.no.",
    'phone' => "Ugyldig telefonnummer",
    'invalid_date_format' => sprintf("Ugyldig datoformat. Bruk formatet '%s'", DATE_FORMAT),
    'future_date' => "Datoen kan ikke være en fremtidig dato.",
    'password' => "Passord må være minst 8 tegn langt, inneholde minst én stor bokstav og ett tall."

];

//Valideringsregler
$RULES = [
    'fname' => [
        'value' => '',
        'validering' => "/^[a-zA-ZæøåÆØÅ]+$/", //Ingen spesialkarakterer, kun bokstaver
        'required' => true,
        'error_message_key' => 'fname',
    ],
    'lname' => [
        'value' => '',
        'validering' => "/^[a-zA-ZæøåÆØÅ]+$/", //Ingen spesialkarakterer, kun bokstaver
        'required' => true,
        'error_message_key' => 'lname',
    ],
    'email' => [
        'value' => '',
        'validering' => FILTER_VALIDATE_EMAIL, //Filter for e-postvalidering
        'required' => true,
        'error_message_key' => 'email',
    ],
    'phone' => [
        'value' => '',
        'validering' => "/^\+?[0-9\s\-\(\)]*$/", //Telefonnummer regex: tillater +()-, mellomrom, og siffer mellom 0-9
        'required' => true,
        'error_message_key' => 'phone',
    ],
    'password' => [
        'value' => '',
        'validering' => "/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/", //Passord regex: minst 8 tegn, og minst en stor bokstav og et siffer
        'required' => true,
        'error_message_key' => 'password',
    ]
];

?>
