<?php
require_once '../config.php';

// this tells phpstorm that $db exists otherwise it will get mad at you
/** @var mysqli $db */
require_once(ROOT . 'includes/database.php');
session_start();

if (!isset($_SESSION['login'])) {
    // Redirect if not logged in
    header('Location: login.php');
    exit();
}

// check if id is set
if (!isset($_GET['id']) || $_GET['id'] == "") {
    header('Location: index.php');
    exit();
}

$id = mysqli_escape_string($db, $_GET['id']);
$formSent = false;

$query = "SELECT * FROM reservations WHERE id = $id";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$reservation = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) != 1) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['no'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['yes'])) {
    $id = $_POST['id'];
    $formSent = true;

    $query = "DELETE FROM reservations WHERE id = ?";
    $result = mysqli_execute_query($db, $query, array($id))
    or die('Error ' . mysqli_error($db) . ' with query ' . $query);
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bulma.css"/>
    <title>Verwijderen - Reserveringen | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Reserveringen > Verwijderen</p>
            <p class="subtitle">Verwijder een reservering uit het systeem</p>
            <a class="button" href="index.php">&laquo; Ga terug</a>
        </div>
        <div>
            <a class="button my-2" href="/logout.php">Uitloggen</a>
            <p class="subtitle"> Hallo, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>
    </div>
</header>
<main class="container">
    <section class="section content">
        <?php if (!isset($_POST['yes'])) { ?>
            <h2 class="title mt-4">Weet je het zeker dat je deze reservering wilt verwijderen?</h2>
            <ul>
                <li>Naam: <?= htmlentities($reservation['last_name']) ?></li>
                <li>Datum: <?= htmlentities($reservation['date']) ?></li>
                <li>Tijd: <?= htmlentities($reservation['start_time']) ?></li>
                <li>Telefoonnummer: <?= htmlentities($reservation['phone']) ?></li>
                <li>Email: <?= htmlentities($reservation['email']) ?></li>
                <li>Speciale
                    Verzoeken: <?= htmlentities($reservation['special_request'] ?? 'nvt') ?></li>
                <li>Allergieën: <?= htmlentities($reservation['allergies'] ?? 'nvt') ?></li>
            </ul>
            <form class="column is-6" action="" method="post">
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="no">Nee</button>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth is-danger" type="submit" name="yes">Ja
                        </button>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $id ?>"/>
            </form>
        <?php } else { ?>
            <h2 class="title mt-4">Reservering verwijderd!</h2>
        <?php } ?>
    </section>
</main>
</body>
</html>