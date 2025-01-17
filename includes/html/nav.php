<?php
// start session voor het laden
$loggedIn = false;
$loggedInText = 'Log In';
$loggedInLink = 'login.php';

// check if logged in
if (isset($_SESSION['login'])) {
    $loggedIn = true;
    $loggedInText = 'Ga naar dashboard';
    $loggedInLink = 'dashboard/index.php';
}
?>
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
                    <?php if (!$loggedIn) { ?>
                        <p class="control">
                            <a class="button is-primary is-soft" href="/reserveren/index.php">
                                <span>Reserveren</span>
                            </a>
                        </p>
                    <?php } ?>
                    <p class="control">
                        <a class="button is-primary is-light"
                           href="<?= $loggedInLink ?>">
                            <span><?= $loggedInText ?></span>
                        </a>
                    </p>
                    <?php if ($loggedIn) { ?>
                        <p class="control">
                            <a class="button is-primary is-soft"
                               href="/logout.php">
                                <span>Uitloggen</span>
                            </a>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</nav>
