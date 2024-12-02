<?php
/**
 * Denne filen inneholder ulike funksjoner til å sanitere og validere input felt 
 * f.eks ved behandling av former for å registrere ny bruker, gjeste- eller admin-innlogging
 * 
 * Funksjoner i denne filen:
 * - check_honeypot()
 * - clean_input()
 * - validate_fields()
 * - validate_future_date()
 */

//Config-fil med statiske verdier: datoformat, feilmeldinger og valideringsregler
require_once 'config.php';

/**
 * Sjekker honeyput feltet for spam bot aktivitet
 * Honeyput er et felt som er gjemt for brukeren slik at de ikke kan fylle det ut.
 * Dersom det er utfylt indikerer det spambot submission av form.
 * 
 * @param string|null @honeypot: Verdien av honeyput feltet fra form submission
 * @return string|null Returnerer feilmelding dersom feltet er utfylt og null om det er tomt
 */
function check_honeypot($honeypot) {
    if (!empty($honeypot)) {
        return "Ugyldig innsending.";
    }
        return null;
}


/**
 * Funksjon som forenkler feltbehandling.
 * Den fjerner ekstra whitespace og saniterer input ved hjelp av filtere.
 * For å bruke sett $input, ($sanitize_filter er valgfri parameter, 
 * dersom den ikke er satt vil funksjonen kun trimme input.)
 * 
 * @param string $input: Input som skal saniteres (F.eks fra brukerskjema)
 * @param int|null $sanitize_filter: PHP filteret som brukes for sanitering (f.eks FILTER_SANITIZE_EMAIL)
 * 
 * Global variabel:
 * @global array $RULES: Innholder regler for saniteringsfiltre
 * 
 * @return string Sanitert input.
 * 
 * @link https://www.php.net/manual/en/function.filter-var.php - Filter_var
 * @link https://www.php.net/manual/en/filter.filters.sanitize.php - Saniteringsfilter
 */
function clean_input($field, $input) {
    global $RULES;
    
    $input = htmlspecialchars(trim($input));

    if (in_array($field, ['firstname', 'lastname'])) {
        $input = ucwords(strtolower($input));
    }
    if (in_array($field, ['email'])) {
        $input = strtolower($input);
    }

    if (isset($RULES[$field]) && isset($RULES[$field]['sanitize_filter'])) {
        $sanitize_filter = $RULES[$field]['sanitize_filter'];
        return filter_var($input, $sanitize_filter);
    }
    return $input;
}


/**
 * Validerer formfelt basert på de gitte valideringsreglene i $RULES
 * Funksjonen itererer gjennom et assosiativt array hvor hvert felt har en spesifikk valideringsregel.
 * Så sjekker den om felt-verdien matcher kriteriene og legger til en feilmelding i error-array
 * dersom valideringen feiler.
 * 
 * @param array $fields: Et assosiativt array med felter som skal valideres.
 * @param array &$errors: Referer til et assosiativt array hvor validerings feilmeldingene
 * skal lagres. Nøklene korresponderer til felt navnene.
 * 
 * Globale variabler:
 * @global array $RULES: Valideringsreglene for ulike felt
 * @global array $ERROR_MESSAGES: Feilmeldinger for ulike validerignsfeil
 */
function validate_fields($fields, &$errors) {
    global $RULES, $ERROR_MESSAGES; //Finnes i inc/config.php
    
    foreach ($fields as $field => $value) {
        //Hopper over felt uten valideringsregler
        if (!isset($RULES[$field])) {
            continue;
        }
        //Henter valideringsregler fra globale array $RULES
        $rule = $RULES[$field];

        //Sjekker om felt er required og tomt
        if ($rule['required'] && empty($value)) {
            $errors[$field] = sprintf($ERROR_MESSAGES['required'], ucfirst($field));
        }
        else {

            //SJEKK OM SPRINTF KAN FJERNES ////////////////////////////

            //Sjekker om det er en valideringsregel for feltet
            if (isset($rule['validering'])) {
                //Valideringsregelen = string (f.eks. regex)
                if (is_string($rule['validering']) && !preg_match($rule['validering'], $value)) {
                    $errors[$field] = $ERROR_MESSAGES[$rule['error_message_key']];
                }
                //Regel = Email filter
                elseif ($rule['validering'] === FILTER_VALIDATE_EMAIL && !filter_var($value, $rule['validering'])) {
                    $errors[$field] = $ERROR_MESSAGES[$rule['error_message_key']];
                }
            }

            //Egen validering for fødselsdato
            if ($field === 'birthday') {
                $current_date = date(DATE_FORMAT);
                $dateObject = DateTime::createFromFormat(DATE_FORMAT, $value);
                if (!$dateObject) {
                    $errors[$field] = $ERROR_MESSAGES['invalid_date_format'];
                }
                //Sjekker for fremtidig dato
                elseif ($value > $current_date) {
                    $errors[$field] = $ERROR_MESSAGES['future_date'];
                }
                else {
                    //Sjekker om brukeren er under 18
                    $age = date_diff($dateObject, date_create($current_date))->y;
                    if ($age < 18) {
                        $errors[$field] = $ERROR_MESSAGES['underage'];
                    }
                }
                
            }
            //Egen passord validering (sjekker om det matcher kravene)
            if ($field === 'password') {
                if (!preg_match($rule['validering'], $value)) {
                    $errors[$field] = $ERROR_MESSAGES[$rule['error_message_key']];
                }
            }
            //Sjekker om passordbekreftelse matcher
            if ($field === 'confpassword') {
                if ($value !== $fields['password']) {
                    $errors[$field] = $ERROR_MESSAGES[$rule['error_message_key']];
                }
            }
        }
    }
}

/**
 * Funksjonen validerer at en oppgitt dato ikke er i fortiden.
 * Til bruk av fremtidige bookinger.
 * 
 * Lager et dateTime objekt fra en gitt dato string. Deretter legger til en feilmelding i 
 * &$errors array dersom formatet er ugyldig eller datoen er i fortiden.
 *
 * @param string $date: Datoen som skal valideres.
 * @param string $current_date: Dagens dato til sammenligning.
 * @param array &$errors: Assosiativt array hvor feilmeldinger lagres.
 */
function validate_past_date($fields, &$errors) {
    global $RULES, $ERROR_MESSAGES; //Finnes i inc/config.php

    //Ensure that both 'checkin_date' and 'checkout_date' are validated
    $checkin = isset($fields['checkin']) ? $fields['checkin'] : null;
    $checkout = isset($fields['checkout']) ? $fields['checkout'] : null;

    foreach ($fields as $field => $value) {
        //Hopper over felt uten valideringsregler
        if (!isset($RULES[$field])) {
            continue;
        }

        if (!empty($value)) {
            $rule = $RULES[$field];

            //Creates DateTime object from DATE_FORMAT
            $dateObject = DateTime::createFromFormat(DATE_FORMAT, $value);
            if (!$dateObject) {
                $errors[$field] = $ERROR_MESSAGES['invalid_date_format'];
            }
            else {
                //Sjekker om dato er i fortiden
                $current_date = date(DATE_FORMAT);
                if ($dateObject < new DateTime($current_date)) {
                    $errors[$field] = $ERROR_MESSAGES[$rule['error_message_key']];
                }

                //Sjekker at checkout ikke er før checkin
                if ($field === 'checkout' && $checkin) {
                    $checkin_object = DateTime::createFromFormat(DATE_FORMAT, $checkin);
                    if ($dateObject < $checkin_object) {
                        $errors[$field] = $ERROR_MESSAGES[$rule['error_message_key']];
                    }
                }
            }
        }
    }
}





?>
