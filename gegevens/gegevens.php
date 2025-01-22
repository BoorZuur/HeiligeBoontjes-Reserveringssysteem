<?php
    session_start();
    global $db;

    $firstName = '';
    $lastName = '';
    $email = '';
    $phone = '';
    $allergy = '';
    $foodCheck = 'No';
    $specialRequest = 'none';
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        $lounge = '';
        $session = '';
        $tv = 0;
        $flipover = 0;
        $coffee = 0;
        $thea = 0;
        $water = 0;
        $breakfast = '';
        $lunch = '';
        $snacks = '';
    }
    if (isset($_POST['submit'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $allergy = $_POST['allergy'];

        if (isset($_GET['id'])){
            if (isset($_POST['tv']) && $_POST['tv'] == "yes"){
                $tv = true;
            } else {
                $tv = 0;
            }
            if (isset($_POST['flipover']) && $_POST['flipover'] == "yes"){
                $flipover = true;
            } else{
                $flipover = 0;
            }
            if (isset($_POST['coffee']) && $_POST['coffee'] == "yes"){
                $coffee = true;
            } else{
                $coffee = 0;
            }
            if (isset($_POST['thea']) && $_POST['thea'] == "yes"){
                $thea = true;
            } else{
                $thea = 0;
            }
            if (isset($_POST['water']) && $_POST['water'] == "yes"){
                $water = true;
            } else{
                $water = 0;
            }
            $lounge = $_POST['send-to'];
            $session = $_POST['session'];
        }

            if (isset($_POST['myCheck']) && $_POST['myCheck'] == "Yes"){
                $foodCheck = "Yes";
                $specialRequest = $_POST['specialRequest'];
                    if (isset($_GET['id'])) {
                        $breakfast = $_POST['breakfast'];
                        $lunch = $_POST['lunch'];
                        $snacks = $_POST['snacks'];
                    }
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
            $_SESSION['specialRequest'] = $specialRequest;
            $_SESSION['tv'] = $tv;
            $_SESSION['flipover'] = $flipover;
            $_SESSION['coffee'] = $coffee;
            $_SESSION['thea'] = $thea;
            $_SESSION['water'] = $water;
            $_SESSION['breakfast'] = $_POST['breakfast'];
            $_SESSION['lunch'] = $_POST['lunch'];
            $_SESSION['snacks'] = $_POST['snacks'];
            $_SESSION['lounge'] = $lounge;
            $_SESSION['session'] = $session;
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
        <?php
        if (isset($_GET['id'])){
        ?>
        <dialog>
            <button autofocus>X</button>
            <h5>Ontbijt opties <b>tot 11:00</b></h5>
            <br>
            <p>
                <b>Ontbijt A - €13,50</b><br>
                - Desem en spelt brood<br>
                - Divers beleg (zoet en hartig)<br>
                - Verse jus d'orange<br>
                - Bakkie pleur of bakkie thee<br>
                - Specials tegen meerprijs verkrijgbaar (+€0,65)<br>
            </p>
            <p>
                <b>Ontbijt B - €16,00</b><br>
                - Desem en spelt brood<br>
                - Divers beleg (zoet en hartig)<br>
                - Croissant<br>
                - Gekookt ei<br>
                - Verse jus d'orange<br>
                - Bakkie pleur of bakkie thee<br>
                - Specials tegen meerprijs verkrijgbaar (+€0,65)<br>
            </p>
            <p>
                <b>Ontbijt C - €16,00</b><br>
                - Desem en spelt brood<br>
                - Divers beleg (zoet en hartig)<br>
                - Croissant<br>
                - Gekookt ei<br>
                - Yoghurt met muesli<br>
                - Handfruit<br>
                - Verse jus d'orange<br>
                - Bakkie pleur of bakkie thee<br>
                - Specials tegen meerprijs verkrijgbaar (+€0,65)<br>
            </p>

            <h5>Lunch opties <b>van 11:00 tot 17:00</b></h5>
            <br>
            <p>
                <b>Lunch A - €14,50</b><br>
                - Desem en spelt brood<br>
                - Divers beleg (zoet en hartig)<br>
                - Verse jus d'orange<br>
                - Bakkie pleur of bakkie thee<br>
                - Specials tegen meerprijs verkrijgbaar (+€0,65)<br>
            </p>
            <p>
                <b>Lunch B - €19,50</b><br>
                - Desem en spelt brood<br>
                - Divers beleg (zoet en hartig)<br>
                - Handfruit en frisse salade<br>
                - Kroket (rund en/of vega)<br>
                - Verse jus d'orange<br>
                - Bakkie pleur of bakkie thee<br>
                - Specials tegen meerprijs verkrijgbaar (+€0,65)<br>
            </p>
            <p>
                <b>Lunch C - €24,50</b><br>
                - Desem en spelt brood<br>
                - Divers beleg (zoet en hartig)<br>
                - Handfruit en frisse salade<br>
                - Soep van de dag<br>
                - Kroket (rund en/of vega)<br>
                - Verse jus d'orange<br>
                - Bakkie pleur of bakkie thee<br>
                - Specials tegen meerprijs verkrijgbaar (+€0,65)<br>
            </p>
            <h5>Borrelarrangement <b>van 11:00 tot 17:00</b></h5>
            <br>
            <p>
                <b>Snacks A koud - €14,50</b><br>
                - Kaas oud en jong met mosterd<br>
                - Notenmelange<br>
                - Cornichon garnituur<br>
            </p>
            <p>
                <b>Snacks B warm - €14,50</b><br>
                - Variatie van warme snacks met twee soorten saus<br>
            </p>
            <p>
                <b>Snacks A warm & koud - €14,50</b><br>
                - Kaas oud en jong met mosterd<br>
                - Notenmelange<br>
                - Cornichon garnituur<br>
                - Variatie van warme snacks met twee soorten saus<br>
            </p>
        </dialog>
        <button class="mini_button">Lounge menu</button>

        <script>
            const dialog = document.querySelector("dialog");
            const showButton = document.querySelector("dialog + button");
            const closeButton = document.querySelector("dialog button");

            // "Show the dialog" button opens the dialog modally
            showButton.addEventListener("click", () => {
                dialog.showModal();
            });

            // "Close" button closes the dialog
            closeButton.addEventListener("click", () => {
                dialog.close();
            });
        </script>
        <?php }?>
        <div class="center-container">
            <section class="contacts-h2">
                <h2>Gegevens invoeren</h2>
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
                <?php
                if (isset($_GET['id'])){
                ?>
                <div class="form-box">
                    <label for="send-to" class="bold">Waarvoor wilt u de lounge gebruiken?</label>
                    <select name="send-to" id="send-to">
                        <option value="" disabled selected>Kies een gebruik</option>
                        <option value="vergadering">Vergadering</option>
                        <option value="presentatie">Presentatie</option>
                        <option value="studie sessie">Studie sessie</option>
                    </select>
                </div>
                    <div>
                        <label>Huur vergaderbenodigheden</label><br>
                        <input type="checkbox" id="tv" name="tv" value="yes">
                        <label for="voorwaarden">TV scherm</label>

                        <input type="checkbox" id="flipover" name="flipover" value="yes">
                        <label for="flipover">flipover</label>
                    </div>
                    <div>
                        <label>Vergaderarrangement</label><br>
                        <input type="checkbox" id="coffee" name="coffee" value="yes">
                        <label for="coffee">1L koffie kan, per kan</label>

                        <input type="checkbox" id="thea" name="thea" value="yes">
                        <label for="thea">1L thee kan, per kan</label>

                        <input type="checkbox" id="water" name="water" value="yes">
                        <label for="water">1L water, per kan</label>
                    </div>
                    <div class="form-box">
                        <label for="session" class="bold">Wilt u een inspiratiesessie bij de lounge?(1 uur)</label>
                        <select name="session" id="session">
                            <option value="geen sessie" selected>Geen sessie</option>
                            <option value="inspiratiesessie voor max 8 personen">inspiratiesessie voor max 8 personen</option>
                            <option value="inspiratiesessie vanaf 8 personen">inspiratiesessie vanaf 8 personen</option>
                        </select>
                    </div>
                <?php }?>
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
                <?php
                if (isset($_GET['id'])){
                ?>
                    <label class="bold" for="breakfast">Welk ontbijt menu zou u willen hebben</label>
                <div class="category-box">
                    <div>
                        <input type="radio" id="A" name="breakfast" value="A" checked>
                        <label for="A">Ontbijt A</label>
                    </div>
                    <div>
                        <input type="radio" id="B" name="breakfast" value="B">
                        <label for="B">Ontbijt B</label>
                    </div>
                    <div>
                        <input type="radio" id="C" name="breakfast" value="C">
                        <label for="C">Ontbijt C</label>
                    </div>
                    <div>
                        <input type="radio" id="C" name="breakfast" value="none">
                        <label for="zero">Geen ontbijt</label>
                    </div>
                </div>
                <br>

                    <label class="bold" for="lunch">Welk lunch menu zou u willen hebben</label>
                    <div class="category-box">
                        <div>
                            <input type="radio" id="A" name="lunch" value="A" checked>
                            <label for="A">Lunch A</label>
                        </div>
                        <div>
                            <input type="radio" id="B" name="lunch" value="B">
                            <label for="B">Lunch B</label>
                        </div>
                        <div>
                            <input type="radio" id="C" name="lunch" value="C">
                            <label for="C">Lunch C</label>
                        </div>
                        <div>
                            <input type="radio" id="C" name="lunch" value="none">
                            <label for="zero">Geen lunch</label>
                        </div>
                    </div>
                    <br>

                    <label class="bold" for="snacks">Zou u snacks willen?</label>
                    <div class="category-box">
                        <div>
                            <input type="radio" id="A" name="snacks" value="A" checked>
                            <label for="A">Snacks A koud</label>
                        </div>
                        <div>
                            <input type="radio" id="B" name="snacks" value="B">
                            <label for="B">Snacks B warm</label>
                        </div>
                        <div>
                            <input type="radio" id="C" name="snacks" value="C">
                            <label for="C">Snacks B warm & koud</label>
                        </div>
                        <div>
                            <input type="radio" id="C" name="snacks" value="none">
                            <label for="zero">Geen snacks</label>
                        </div>
                    </div>
                    <br>
                <?php }?>
                <label class="bold" for="specialRequest">Wilt u uw eten halal, vegan of vegatarisch?</label>
                <div class="category-box">
                    <div>
                        <input type="radio" id="Halal" name="specialRequest" value="halal">
                        <label for="Halal">Halal</label>
                    </div>
                    <div>
                        <input type="radio" id="Vegan" name="specialRequest" value="vegan">
                        <label for="Vegan">Vegan</label>
                    </div>
                    <div>
                        <input type="radio" id="Vegatarisch" name="specialRequest" value="vegetarian">
                        <label for="Vegatarisch">Vegatarisch</label>
                    </div>
                    <div>
                        <input type="radio" id="none" name="specialRequest" value="none" checked>
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