<?php
// form validation

// check if logged in
function checkLoggedIn(): void
{
    if (!isset($_SESSION['login'])) {
        // Redirect if not logged in
        header('Location: ' . HTTP . 'login.php');
        exit();
    }
}

// sendReservationEmail('stefhuijsdens@gmail.com', 'Huijsdens', '17-01-2025', '17:00', 'honderd miljoen');

// send reservation email
function sendReservationEmail($recipient, $name, $date, $time, $guestAmount): bool
{
    require_once "includes/sendEmail.php";

    $subject = "Bevestiging van uw reservering bij de Heilige Boontjes op " . $date;
    $message = "<p>Beste " . htmlentities($name) . ",<br><br>
                Hierbij de bevestiging van uw reservering bij de Heilige Boontjes.<br><br>
                Wanneer: " . htmlentities($date) . "<br>
                Hoe laat: " . htmlentities($time) . "<br>
                Aantal personen: " . htmlentities($guestAmount) . "<br><br>
                Met vriendelijke groet,<br><br>
                <b>Heilige Boontjes</b><br>
                Locatie: Eendrachtsplein 3, 3015 LA Rotterdam<br>
                Telefoonnummer: 010 840 13 83</p>
                <img src='cid:logo' alt='logo'>";
    $sendEmail = sendEmail($recipient, $subject, $message);
    if ($sendEmail) {
        return true;
    } else {
        return false;
    }
}

function sendAccountEmail($recipient, $first_name, $last_name, $phone, $password): bool
{
    require_once "includes/sendEmail.php";

    $subject = "Account Heilige Boontjes";
    $message = "<p>Beste " . htmlentities($first_name) . ",<br><br>
                Welkom bij de Heilige Boontjes!<br>
                We kijken ernaar uit om samen te werken en jouw talenten en vaardigheden te zien bijdragen aan ons team.<br><br>
                Voornaam: " . htmlentities($first_name) . "<br>
                Achternaam: " . htmlentities($last_name) . "<br>
                Telefoonnummer: " . htmlentities($phone) . "<br>
                Email: " . htmlentities($recipient) . "<br>
                Wachtwoord: " . htmlentities($password) . "<br><br>
                Als je vragen hebt of als er verkeerde informatie in het systeem staat, aarzel dan niet om contact op te nemen met je leidinggevende<br><br>
                Met vriendelijke groet,<br><br>
                <b>Heilige Boontjes</b><br>
                Locatie: Eendrachtsplein 3, 3015 LA Rotterdam<br>
                Telefoonnummer: 010 840 13 83</p>
                <img src='cid:logo' alt='logo'>";
    $sendEmail = sendEmail($recipient, $subject, $message);
    if ($sendEmail) {
        return true;
    } else {
        return false;
    }
}

function createRandomPass(): string
{
    $password = "";
    for ($i = 0; $i < 10; $i++) {
        $character = chr(rand(48, 122));
        $password = $password . $character;
    }

    return $password;
}