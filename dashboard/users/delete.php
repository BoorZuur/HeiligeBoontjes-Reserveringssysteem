<?php
require_once '../../config.php';

// this tells phpstorm that $db exists otherwise it will get mad at you
/** @var mysqli $db */
require_once(ROOT . 'includes/database.php');
session_start();

if (!isset($_SESSION['login'])) {
    // Redirect if not logged in
    header('Location: login.php');
    exit();
}

// check if user is admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../reservations.php');
}

// check if id is set
if (!isset($_GET['id']) || $_GET['id'] == "") {
    header('Location: index.php');
    exit();
}

$id = mysqli_escape_string($db, $_GET['id']);
$formSent = false;

// sql injection ?!
$query = "SELECT * FROM albums WHERE id = $id";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$album = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) != 1) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['no'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['yes'])) {
    $formSent = true;

    require_once('includes/database.php');

    $query = "DELETE FROM users WHERE id = ?";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <title>Muziekalbums - Create</title>
</head>
<body>
<div class="container px-4">
    <section class="columns is-centered">
        <div class="column is-10">
            <?php if (!isset($_POST['yes'])) { ?>
                <h2 class="title mt-4">Are you sure you want to delete this album?</h2>
                <p>Album: <?= $album['name'] ?></p>
                <p>Artist: <?= $album['artist'] ?></p>
                <p>Genre: <?= $album['genre'] ?></p>
                <p>Year: <?= $album['year'] ?></p>
                <p>Tracks: <?= $album['tracks'] ?></p>
                <form class="column is-6" action="" method="post">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="no">No</button>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth is-danger" type="submit" name="yes">Yes</button>
                        </div>
                    </div>
                </form>
            <?php } else { ?>
                <h2 class="title mt-4">Album deleted!</h2>
            <?php } ?>
            <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
        </div>
    </section>
</div>
</body>
</html>