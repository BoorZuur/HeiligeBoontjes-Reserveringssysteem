<?php
session_start();

$loggedIn = false;
$loggedInText = 'Log In';
$loggedInLink = 'login.php';

// check if logged in
if (isset($_SESSION['login'])) {
    $loggedIn = true;
    $loggedInText = 'Dashboard';
    $loggedInLink = 'dashboard/index.php';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bulma.css"/>
    <script type="text/javascript" src="/js/navbar.js"></script>
    <title>Reserveren | Heilige Boontjes</title>
</head>
<body>
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="/index.php">
            <figure class="image is-640x160">
                <img src="/images/logo.svg" alt="logo"/>
            </figure>
        </a>
        <div class="navbar-burger js-burger" data-target="navMenuColorprimary">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navMenuColorprimary" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="https://www.heiligeboontjes.com/webshop/"> Webshop </a>
            <div class="navbar-item has-dropdown">
                <a class="navbar-link"> Grand Cafe </a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="https://bulma.io/documentation/overview/start/"> Info </a>
                    <a class="navbar-item" href="https://bulma.io/documentation/overview/modifiers/"> Menu </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item is-active" href="https://bulma.io/documentation/columns/basics/">
                        Reserveren </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field is-grouped">
                    <p class="control">
                        <a class="button is-primary is-soft" href="/reserveren/index.php">
                            <span>Reserveren</span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-primary is-light"
                           href="<?= $loggedInLink ?>">
                            <span><?= $loggedInText ?></span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</nav>
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
            <div class="section columns is-centered">
                <div class="column is-narrow">
                    <a class="button is-info"
                       href="https://www.heiligeboontjes.com/menu.pdf">Neem
                        vast een kijkje in ons menu</a>
                </div>
                <div class="column is-narrow">
                    <a class="button is-link"
                       href="/reserveren/index.php">Reserveer een plekje</a>
                </div>
            </div>
        </div>
    </section>
</main>
<footer></footer>
</body>
</html>
