<?php
/**
 * Denne filen lagrer statiske verdier som:
 * - Datoformat
 * - Feilmeldinger
 * - Valideringsregler
 */

 //Datoformat
 if (!defined('DATE_FORMAT')) {
    define('DATE_FORMAT', 'd-m-Y');
}

//Inneholder standard feilmeldinger for ulike typer valideringsfeil
$ERROR_MESSAGES = [
    'honeypot' => "Invalid submission.",
    'required' => "%s is required, the field cannot be empty.",
    'firstname' => "Please check that the first name does not contain special characters.",
    'lastname' => "Please check that the last name does not contain special characters.",
    'email' => "Please check that the email has the correct format - e.g. user@example.no.",
    'phone' => "Invalid phone number",
    'invalid_date_format' => sprintf("Invalid date format. Please use the format '%s'", DATE_FORMAT),
    'underage' => "You have to be 18 years or older to become a member.",
    'future_date' => "The date cannot be a future date.",
    'password' => "Password must be at least 8 characters long, contain at least one uppercase letter and one number."

];

//Valideringsregler for ulike felt
$RULES = [
    'honeypot' => [
        'value' => '',
        'required' => false,
        'sanitize_filter' => null,
        'error_message_key' => 'honeypot'
    ],
    'firstname' => [
        'value' => '',
        'validering' => "/^[a-zA-ZæøåÆØÅ]+$/", //Ingen spesialkarakterer, kun bokstaver
        'required' => true,
        'sanitize_filter' => FILTER_SANITIZE_STRING,
        'error_message_key' => 'firstname'
    ],
    'lastname' => [
        'value' => '',
        'validering' => "/^[a-zA-ZæøåÆØÅ]+$/",
        'required' => true,
        'sanitize_filter' => FILTER_SANITIZE_STRING,
        'error_message_key' => 'lastname'
    ],
    'email' => [
        'value' => '',
        'validering' => FILTER_VALIDATE_EMAIL, //Filter for e-postvalidering
        'required' => true,
        'sanitize_filter' => FILTER_SANITIZE_EMAIL,
        'error_message_key' => 'email'
    ],
    'phone' => [
        'value' => '',
        'validering' => "/^\+?[0-9\s\-\(\)]*$/", //Telefonnummer regex: tillater +()-, mellomrom, og siffer mellom 0-9
        'required' => true,
        'sanitize_filter' => null,
        'error_message_key' => 'phone'
    ],
    'birthday' => [
        'value' => '',
        'validering' => null,
        'required' => true,
        'sanitize_filter' => null,
        'error_message_key' => 'underage'
    ],
    'password' => [
        'value' => '',
        'validering' => "/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/", //Passord regex: minst 8 tegn, og minst en stor bokstav og et siffer
        'required' => true,
        'sanitize_filter' => null,
        'error_message_key' => 'password'
    ]
];

?>
