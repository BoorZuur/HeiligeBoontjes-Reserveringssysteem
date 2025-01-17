<?php
    session_start();
    global $db;
    $firstName = '';
    $lastName = '';
    $email = '';
    $phone = '';
    $allergy = '';
    $people = $_SESSION['people'];
    $location = $_SESSION['location'];
    $foodCheck = 'No';
    $preference = 'none';

    if (isset($_POST['submit'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $allergy = $_POST['allergy'];

        if (isset($_POST['myCheck']) && $_POST['myCheck'] == "Yes"){
            $foodCheck = "Yes";
            $preference = $_POST['preference'];
        }

        $errors = [];

        if ($firstName == ''){
            $errors['emptyfirst'] = 'Voornaam mag niet leeg zijn';
        }
        if ($lastName == ''){
            $errors['emptylast'] = 'Achternaam mag niet leeg zijn';
        }
        if ($email == ''){
            $errors['emptyemail'] = 'E-mail mag niet leeg zijn';
        }    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "E-mailadress is ongeldig";}
        if ($phone == ''){
            $errors['emptyphone'] = 'Telefoonnummer mag niet leeg zijn';
        }elseif (strlen($phone)<9){
            $errors['shortphone'] = 'Telefoonnummer moet minimaal 10 karakters zijn';
        }elseif (strlen($phone)>15){
            $errors['longphone'] = 'Telefoonnummer kan niet langer dan 15 karakters zijn';
        }
        if (empty($errors)){
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['foodCheck'] = $foodCheck;
            $_SESSION['allergy'] = $allergy;
            $_SESSION['preference'] = $preference;
            $_SESSION['people'] = $people;
            $_SESSION['location'] = $location;
            header('Location: confirm.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
<header class="h-contacts">
    <h1>Reservering</h1>
    <p>
        Vul uw gegevens onderin in om
    </p>
</header>

<main>
    <section>
        <div class="center-container">
            <section class="contacts-h2">
                <h2>Gegevens invoeren</h2>
                <?=
                $location;
                ?>
                <?=
                $people;
                ?>
            </section>
            <form action="" method="POST">
                <div class="name">
                    <div class="form-box">
                        <label class="bold" for="firstName">Voornaam</label>
                        <input type="text" name="firstName" id="firstName" placeholder="Voornaam" value="<?= htmlentities($firstName) ?>" class="input-box">
                        <p class="error">
                            <?= $errors['emptyfirst'] ?? '' ?>
                        </p>
                    </div>

                    <div class="form-box">
                        <label class="bold" for="lastName">Achternaam</label>
                        <input type="text" name="lastName" id="lastName" placeholder="Achternaam" value="<?= htmlentities($lastName) ?>" class="input-box">
                        <p class="error">
                            <?= $errors['emptylast'] ?? '' ?>
                        </p>
                    </div>
                </div>

                <div class="name">
                <div class="form-box">
                    <label class="bold" for="email">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="E-mail" value="<?= htmlentities($email) ?>" class="input-box">
                    <p class="error">
                        <?= $errors['emptyemail'] ?? '' ?>
                    </p>

                    <p class="error">
                        <?= $errors['email'] ?? '' ?>
                    </p>
                </div>
                    <div class="form-box">
                    <label class="bold" for="phone">Telefoonnummer</label>
                    <input type="text" name="phone" id="phone" value="<?= htmlentities($phone) ?>" class="input-box">
                    <p class="error">
                        <?= $errors['emptyphone'] ?? '' ?>
                    </p>
                        <p class="error">
                            <?= $errors['shortphone'] ?? '' ?>
                        </p>
                        <p class="error">
                            <?= $errors['longphone'] ?? '' ?>
                        </p>
                    </div>
                </div>
                <div id="eten">
                    <input type="checkbox" id="myCheck" onclick="myFunction()" name="myCheck" value="Yes">
                    <label for="myCheck">Bent u van plan om bij ons te eten?</label>
                </div>

                <script>
                    function myFunction() {
                        let checkBox = document.getElementById("myCheck");
                        let text = document.getElementById("text");
                        if (checkBox.checked === true) {
                            text.style.display = "block";
                        } else {
                            text.style.display = "none";
                        }
                    }
                </script>
            <div id="text" style="display:none">
                <label class="bold" for="preference">Wilt u uw eten halal, vegan of vegatarisch?</label>
                <div class="category-box">
                    <div>
                        <input type="radio" id="Halal" name="preference" value="Halal">
                        <label for="Halal">Halal</label>
                    </div>
                    <div>
                        <input type="radio" id="Vegan" name="preference" value="Vegan">
                        <label for="Vegan">Vegan</label>
                    </div>
                    <div>
                        <input type="radio" id="Vegatarisch" name="preference" value="Vegatarisch">
                        <label for="Vegatarisch">Vegatarisch</label>
                    </div>
                    <div>
                        <input type="radio" id="none" name="preference" value="Geen voorkeuren" checked>
                        <label for="none">Geen voorkeur</label>
                    </div>
                </div>
                    <br>
                    <div class="form-box">
                        <label class="bold" for="allergy">Heeft u nog allergiën waar wij rekening mee moeten houden?</label>
                        <input type="text" name="allergy" id="allergy" value="<?= htmlentities($allergy) ?>" class="input-box">
                    </div>
            </div>
                <button type="submit" name="submit">Verzenden</button>
            </form>

        </div>
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
                <a target="_blank" href="https://www.instagram.com/heiligeboontjes/?hl=nl/"><img src="images/HB_Style_Instagram.png" alt="instagram"></a>
                <a target="_blank" href="https://www.facebook.com/HB.koffie/"><img src="images/HB_Style_Facebook.png" alt="facebook"></a>
                <a target="_blank" href="https://www.linkedin.com/company/heiligeboontjes/"><img src="images/HB_Style_Linkedin.png" alt="linkedin"></a>
                <a target="_blank" href="https://x.com/heiligeboontjes"><img src="images/HB_Style_Twitter.png" alt="twitter"></a>
            </div>
        </div>
        <div class="footer-extra">
            <h4>Wil je ons supporten</h4>
            <a target="_blank" href="https://www.heiligeboontjes.com/doneren/" class="small-button">Doneren</a>
        </div>
        <div class="footer-extra">
            <h4>Klantenservice</h4>
            <a target="_blank" href="https://www.heiligeboontjes.com/verzending-retournering/" class="link">Verzendingen & reserveringen</a>
            <a target="_blank" href="https://www.heiligeboontjes.com/algemene-voorwaarden/" class="link">Algemene voorwaarden</a>
            <a target="_blank" href="https://www.heiligeboontjes.com/prestatieladder-socialer-ondernemen/"><img class="pso" src="images/PSO123.png" alt="pso123"></a>
        </div>
        <div class="footer-extra">
            <h4>Penthouse prison</h4>
            <a target="_blank" href="https://www.heiligeboontjes.com/penthouse-prison/" class="link"><img class="pso" src="images/airbnb.png" alt="airbnb"></a>
        </div>

    </div>
</footer>
</body>
</html>