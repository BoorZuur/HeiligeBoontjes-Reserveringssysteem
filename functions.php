<?php
// form validation

// check if logged in
function checkLoggedIn(): void
{
    if (!isset($_SESSION['login'])) {
        // Redirect if not logged in
        header('Location: /login.php');
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