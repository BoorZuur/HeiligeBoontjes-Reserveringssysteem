<?php
session_start();
global $db;
require_once '../includes/database.php';
require_once '../config.php';

if (empty($_SESSION['firstName']) && empty($_SESSION['lastName'])
    && empty($_SESSION['email']) && empty($_SESSION['phone'])){
    header('Location: ../index.php');
}
echo $_SESSION['coffee'];
$tableid = 30;
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$firstName = mysqli_real_escape_string($db, $firstName);
$lastName = mysqli_real_escape_string($db, $lastName);
$email = mysqli_real_escape_string($db, $email);
$date = "2025-1-20";
$startTime = "12:00:00";
$endTime = "14:00:00";
if (empty($_SESSION['people']) && empty($_SESSION['location'])){
    $_SESSION['people'] = null;
    $_SESSION['location'] = null;
}
$people = $_SESSION['people'];
$location = $_SESSION['location'];
$allergy = $specialRequest = 'none';
$specialRequest = mysqli_real_escape_string($db, $specialRequest);

if (isset($_SESSION['id'])){
    $tv = $_SESSION['tv'];
    $flipover = $_SESSION['flipover'];
    $coffee = $_SESSION['coffee'];
    $thea = $_SESSION['thea'];
    $water = $_SESSION['water'];
    $breakfast = $_SESSION['breakfast'];
    $lunch = $_SESSION['lunch'];
    $snacks = $_SESSION['snacks'];
    $lounge = $_SESSION['lounge'];
    $session = $_SESSION['session'];
    echo $coffee;
}

if (isset($_SESSION['foodCheck']) && $_SESSION['foodCheck'] == 'Yes') {
    $allergy = $_SESSION['allergy'];
    if (empty($allergy)){$allergy = null;}
    $specialRequest = $_SESSION['specialRequest'];
}
if (isset($_POST['send'])) {
    if (isset($_SESSION['id'])) {
        $query = "INSERT INTO `lounge`
        (`firstName`, `lastName`, `email`, `date`, `start_time`, `end_time`, `special_request`, 
         `tv`, `lounge`, `session`, `flipover`, `coffee`, `thea`, `water`, `breakfast`, `lunch`, `snacks`, 
         `allergy`) 
    VALUES ('$firstName','$lastName','$email','$date','$startTime','$endTime','$specialRequest',
            $tv,'$lounge','$session',$flipover,$coffee,$thea,0,
            '$breakfast','$lunch','$snacks','$allergy')";
        echo $query;

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        sendLoungeEmail($email, $lastName, $date, $startTime, $breakfast, $lunch, $snacks, $coffee, $thea, $water);
        header('Location: ../index.php');
        session_destroy();
        exit();
    } else {
        $query = "INSERT INTO `reservations`
    (`table_id`, 
     `last_name`, 
     `email`, 
     `phone`, 
     `date`, 
     `start_time`, 
     `end_time`, 
     `special_request`, 
     `allergies`) 
VALUES ($tableid,
        '$lastName',
        '$email',
        '$phone',
        '$date',
        '$startTime',
        '$endTime',
        '$specialRequest',
        '$allergy')";

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        sendReservationEmail($email, $lastName, $date, $startTime, $people);
        header('Location: ../index.php');
        session_destroy();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HB_gegevens</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

</head>
<body>
<header class="h-contacts">
    <h1>Reservering</h1>
    <p>
        Vul uw gegevens onderin in om
    </p>
</header>

<main>
    <section class="center-container">
        <p><b>Gegevens</b><br>
            Voornaam: <?= $_SESSION['firstName']; ?><br>
            Achternaam: <?= $_SESSION['lastName']; ?><br>
            E-mail: <?= $_SESSION['email']; ?><br>
            Telefoonnummer: <?= $_SESSION['phone'] ?><br>
            <?php
            if (!empty($_SESSION['people']) && !empty($_SESSION['location'])){
                $_SESSION['people'] = null;
                $_SESSION['location'] = null;
            ?>
            zitplaats: <?= $_SESSION['location']; ?><br>
            mensen: <?= $_SESSION['people']; ?>
            <?php }?>
        </p>
        <?php
        if ($_SESSION['foodCheck'] == 'Yes') {
            ?>
            <p>
                <b>Eten</b><br>
                <?= $_SESSION['specialRequest'] ?? '' ?><br>
                <?= $_SESSION['allergy'] ?? '' ?>
            </p>
            <?php
            if (isset($_SESSION['id'])){
            ?>
                <p>
                    <b>Lounge</b><br>
                    lounge gebruik: <?=$lounge?><br>
                    inspiratie sessie: <?=$session?><br>
            <?php }?>
        <?php } ?>
        <?php
            if (isset($_SESSION['tv']) && $_SESSION['tv'] == 1){?>
            Tv scherm<br>
            <?php } ?>
        <?php if (isset($_SESSION['flipover'])&& $_SESSION['flipover'] == 1){?>
            flipover<br>
        <?php }?>
        <?php if (isset($_SESSION['coffee'])&& $_SESSION['coffee'] == 1){?>
            1L koffie kan<br>
        <?php }?>
        <?php if (isset($_SESSION['thea'])&& $_SESSION['thea'] == 1){?>
            1L thee kan<br>
        <?php }?>
        <?php
        if (isset($_SESSION['water'])&& $_SESSION['water'] == 1){?>
            1L water kan</p>
        <?php }?>


        <form action="" method="post">
            <input type="hidden" name="hidden" value="<?= $lastName ?>">
            <input type="hidden" name="hidden" value="<?= $email ?>">
            <input type="hidden" name="hidden" value="<?= $phone ?>">
            <input type="hidden" name="hidden" value="<?= $date ?>">
            <input type="hidden" name="hidden" value="<?= $startTime ?>">
            <input type="hidden" name="hidden" value="<?= $endTime ?>">
            <input type="hidden" name="hidden" value="<?= $specialRequest ?>">
            <input type="hidden" name="hidden" value="<?= $allergy ?>">
            <button type="submit" name="send">confirm</button>
        </form>
        <a class="small-button" href="cancel.php">cancel</a>
    </section>
</main>

<footer>
    <hr width="100%" size="30" color="#b97c42">
    <div class="footer-box">
        <div class="footer-extra">
            <h4>Eendrachtsplein</h4>
            <p>Eendrachtsplein 3, 3015 LA Rotterdam</p>

            <p>Ma 09:00 – 18:00 uur</p>
            <p>Di – Do 08:00 – 18:00 uur</p>
            <p>Vr 08:00 – 19:00 uur</p>
            <p>Za 10:00 – 19:00 uur</p>
            <p>Zo 10:00 – 18:00 uur</p>

            <p>Telefoonnummer: 010 840 13 83</p>
            <p>KVK 66348374</p>
            <div class="social-media">
                <a target="_blank" href="https://www.instagram.com/heiligeboontjes/?hl=nl/"><img
                            src="images/HB_Style_Instagram.png" alt="instagram"></a>
                <a target="_blank" href="https://www.facebook.com/HB.koffie/"><img src="images/HB_Style_Facebook.png"
                                                                                   alt="facebook"></a>
                <a target="_blank" href="https://www.linkedin.com/company/heiligeboontjes/"><img
                            src="images/HB_Style_Linkedin.png" alt="linkedin"></a>
                <a target="_blank" href="https://x.com/heiligeboontjes"><img src="images/HB_Style_Twitter.png"
                                                                             alt="twitter"></a>
            </div>
        </div>
        <div class="footer-extra">
            <h4>Wil je ons supporten</h4>
            <a target="_blank" href="https://www.heiligeboontjes.com/doneren/" class="small-button">Doneren</a>
        </div>
        <div class="footer-extra">
            <h4>Klantenservice</h4>
            <a target="_blank" href="https://www.heiligeboontjes.com/verzending-retournering/" class="link">Verzendingen
                & reserveringen</a>
            <a target="_blank" href="https://www.heiligeboontjes.com/algemene-voorwaarden/" class="link">Algemene
                voorwaarden</a>
            <a target="_blank" href="https://www.heiligeboontjes.com/prestatieladder-socialer-ondernemen/"><img
                        class="pso" src="images/PSO123.png" alt="pso123"></a>
        </div>
        <div class="footer-extra">
            <h4>Penthouse prison</h4>
            <a target="_blank" href="https://www.heiligeboontjes.com/penthouse-prison/" class="link"><img class="pso"
                                                                                                          src="images/airbnb.png"
                                                                                                          alt="airbnb"></a>
        </div>

    </div>
</footer>
</body>
</html>
