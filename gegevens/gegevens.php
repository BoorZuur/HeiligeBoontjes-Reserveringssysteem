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
<nav>
    <div class="nav-box">
        <a href="index.html">Reizen</a>
        <a href="index.html">Plannen</a>
        <a href="index.html">Deals</a>
        <a href="index.html">Uitgelicht</a>
        <a class="contact-nav" href="contacten.html">Contact</a>
    </div>
</nav>
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
            </section>
            <form>
                <div class="name">
                    <div class="form-box">
                        <label class="bold" for="name">Voornaam</label>
                        <input type="text" name="name" id="name" placeholder="Voornaam" required class="input-box">
                    </div>

                    <div class="form-box">
                        <label class="bold" for="name">Achternaam</label>
                        <input type="text" name="name" id="name" placeholder="Achternaam" required class="input-box">
                    </div>
                </div>
                <div class="form-box">
                    <label class="bold" for="email">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="E-mail" required class="input-long">
                </div>
                <div class="time">
                <div class="form-box">
                    <label class="bold" for="van">van</label>
                    <input type="time" name="van" id="van" required min="9:00" max="18:00" class="input-box">
                </div>

                    <div class="form-box">
                        <label class="bold" for="tot">tot</label>
                        <input type="time" name="tot" id="tot" required class="input-box">
                    </div>
                </div>

                <div id="eten">
                    <input type="checkbox" id="myCheck" onclick="myFunction()" name="myCheck" required>
                    <label for="myCheck">Bent u van plan om bij ons te eten?</label>
                </div>

                <script>
                    function myFunction() {
                        var checkBox = document.getElementById("myCheck");
                        var text = document.getElementById("text");
                        if (checkBox.checked == true){
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
                </div>
                    <br>
                    <div class="form-box">
                        <label class="bold" for="allergy">Heeft u nog allergiën waar wij rekening mee moeten houden?</label>
                        <input type="text" name="allergy" id="allergy" placeholder="Allergiën" required class="input-box">
                    </div>
            </div>
                <button type="submit">Verzenden</button>
        </div>
        </form>
    </section>
</main>

<footer>
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
                <a target="_blank" href="https://www.instagram.com/heiligeboontjes/?hl=nl/"><img src="../images/HB_Style_Instagram.png" alt="instagram"></a>
                <a target="_blank" href="https://www.facebook.com/HB.koffie/"><img src="../images/HB_Style_Facebook.png" alt="facebook"></a>
                <a target="_blank" href="https://www.linkedin.com/company/heiligeboontjes/"><img src="../images/HB_Style_Linkedin.png" alt="linkedin"></a>
                <a target="_blank" href="https://x.com/heiligeboontjes"><img src="../images/HB_Style_Twitter.png" alt="twitter"></a>

            </div>
        </div>
        <nav>
            <a target="_blank" href="#">Privacyverklaring</a>
            <a target="_blank" href="#">Algemene voorwaarden</a>
            <a target="_blank" href="#">Cookiebeleid</a>
            <a href="contacten.html">Contact</a>
        </nav>
    </div>
</footer>
</body>
</html>