<?php
require_once 'config.php';

session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bulma.css"/>
    <script type="text/javascript" src="./js/navbar.js"></script>
    <title>Reserveren | Heilige Boontjes</title>
</head>
<body>
<?php require_once ROOT . 'includes/html/nav.php'; ?>
<header class="container">
    <section class="section is-small">
        <figure class="image is-fullwidth">
            <img src="https://www.heiligeboontjes.com/wp-content/uploads/2022/05/header_grandcafe.jpg"
                 alt="Grand Cafe Heilige Boontjes"/>
        </figure>
    </section>
</header>
<main class="container">
    <section class="section">
        <div class="content">
            <h1 class="title">Grand Café op het Eendrachtsplein</h1>
            <p>Op het Eendrachtsplein 3 in Rotterdam vind je ons Grand Café in het voormalige politiebureau “Bureau
                Eendracht”. Elke dag van de week kun je bij ons terecht voor een breed assortiment aan eten en drinken.
                Niet alleen de lekkerste koffie en thee kun je bij ons nuttigen, maar ook allerhande fris, sapjes,
                bieren, wijnen etc.</p>
            <p class="">Heb je trek? We serveren ontbijt, lunch en snacks de hele dag door. In de ochtend een burger of
                een
                croissantje bij de borrel? Maakt ons niet uit, hoor. Bij ons kun je gewoon de hele dag kanen* waar jij
                trek in hebt. Als het op onze kaart staat, natuurlijk. Maar da’s logisch. Dus doe waar je zin in hebt.
                Doen wij dat ook!</p>
            <p><em>* Het Rotterdamse woord voor iets in je gezicht stoppen</em></p>
            <h1 class="title">Reserveren bij ons</h1>
            <h2 class="subtitle is-3">Restaurant</h2>
            <p>Wil je op het terras, restaurant of in de laptop corner een plekje reserveren?
                Maak nu lekker simpel een reservatie bij ons.
            </p>
            <h2 class="subtitle is-3">Lounge</h2>
            <p>Wil je met een groter groepje komen eten, of heb je een ruimte nodig voor
                een vergadering of presentatie? Boek onze lounge kamer!</p>
            <div class="section columns is-centered">
                <div class="column is-narrow">
                    <a class="button is-info"
                       href="https://www.heiligeboontjes.com/menu.pdf">Neem
                        vast een kijkje in ons menu</a>
                </div>
                <div class="column is-narrow">
                    <a class="button is-link"
                       href="/reserveren/index.php">Reserveer restaurant</a>
                </div>
                <div class="column is-narrow">
                    <a class="button is-link"
                       href="/reserveren/index.php">Reserveer </a>
                </div>
            </div>
        </div>
    </section>
</main>
<footer></footer>
</body>
</html>
