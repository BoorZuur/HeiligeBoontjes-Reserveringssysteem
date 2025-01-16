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
            </section>
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="images/Blueprints-14.png" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="images/Blueprints-13.png" style="width:100%">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="images/Blueprints-12.png" style="width:100%">
                    <div class="text">Caption Three</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
            <script>
                let slideIndex = 1;
                showSlides(slideIndex);

                // Next/previous controls
                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                // Thumbnail image controls
                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("dot");
                    if (n > slides.length) {slideIndex = 1}
                    if (n < 1) {slideIndex = slides.length}
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active";
                }
            </script>
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
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