<?php
// navbar voor de medewerkers en admin
// start session voor het laden
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    // Redirect if not logged in
    header('Location: /login.php');
    exit();
}

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
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="/dashboard/index.php">
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
            <a class="navbar-item" href="/dashboard/index.php"> Reserveringen </a>
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <a class="navbar-item" href="/dashboard/employees/index.php"> Medewerkers </a>
            <?php } ?>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">Hallo <?= htmlentities($_SESSION['first_name']) ?>!</div>
            <div class="navbar-item">
                <div class="field is-grouped">
                    <p class="control">
                        <a class="button is-primary is-light"
                           href="/index.php">
                            <span>Terug naar website</span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-primary is-soft"
                           href="/logout.php">
                            <span>Uitloggen</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</nav>
