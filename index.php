<?php
session_start();

$loggedIn = false;
// check if logged in
if (isset($_SESSION['login'])) {
    $loggedIn = true;
}

print_r($_SESSION);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bulma.css"/>
    <title>Reserveren | Heilige Boontjes</title>
</head>
<body>
<nav>
    <div class="is-flex is-justify-content-space-between">
        <div class="is-flex-grow-1"></div>
        <a class="has-text-link m-4" href="login.php">Inloggen</a>
    </div>
</nav>
<header></header>
<main>
    <!-- TODO: reserveren form -->
</main>
<footer></footer>
</body>
</html>
