<?php
// form validation

// check if logged in
function checkLoggedIn(): bool
{
    if (isset($_SESSION['login'])) {
        return true;
    } else {
        return false;
    }
}

/// sendReservationEmail('example@gmail.com', 'Tas', '20/01/2025', '15:00', '69');

// send reservation email
function sendReservationEmail($recipient, $name, $date, $time, $guestAmount): bool
{
    require_once "includes/send_email.php";

    $subject = "Jouw reservering bij de Heilige Boontjes op " . $date;
    $message = "<p>Beste " . htmlentities($name) . ",<br></p>
                <p>Hierbij uw reservering bij de Heilige Boontjes<br></p>
                <p>Wanneer: " . htmlentities($date) . "</p>
                <p>Hoe laat: " . htmlentities($time) . "</p>
                <p>Aantal personen: " . htmlentities($guestAmount) . "<br></p>
                <p>Met vriendelijke groet\r\nHeilige Boontjes</p>";

    $sendEmail = sendEmail($recipient, $subject, $message);
    if ($sendEmail) {
        return true;
    } else {
        return false;
    }
}