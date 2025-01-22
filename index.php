<?php
require_once 'config.php';

session_start();
?>
<!doctype html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= HTTP ?>css/bulma.css"/>
    <script type="text/javascript" src="<?= HTTP ?>js/navbar.js"></script>
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
        </div>
    </section>
    <section class="section">
        <h1 class="title">Reserveren bij ons</h1>
        <div class="columns is-multiline is-centered">
            <div class="column is-half">
                <a class="notification media" href="<?= HTTP ?>gegevens/table.php">
                    <figure class="media-left">
                <span class="icon has-text-info">
                  <i class="fa fa-lg fa-utensils"></i>
                </span>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <h1 class="title is-size-4">Restaurant</h1>
                            <p class="is-size-5 subtitle">
                                Wil je op het terras, restaurant of in de laptop corner een plekje reserveren? Maak nu
                                lekker simpel een reservatie bij ons.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="column is-half">
                <a class="notification media" href="<?= HTTP ?>gegevens/gegevens.php?id=2">
                    <figure class="media-left">
                <span class="icon has-text-danger">
                  <i class="fa fa-lg fa-couch"></i>
                </span>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <h1 class="title is-size-4">Lounge</h1>
                            <p class="is-size-5 subtitle">
                                Wil je met een groter groepje komen eten, of heb je een ruimte nodig voor een
                                vergadering of presentatie? Boek onze lounge kamer!
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="column is-half is-centered">
                <a class="notification media"
                   href="https://www.heiligeboontjes.com/wp-content/uploads/2024/05/HB-Menukaart-2024.pdf">
                    <figure class="media-left">
                <span class="icon">
                  <i class="has-text-primary fa fa-book-open fa-lg"></i>
                </span>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <h1 class="title is-size-4">Menu</h1>
                            <p class="is-size-5 subtitle">
                                Neem vast een kijkje in ons menu
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>
<footer></footer>
</body>
</html>
