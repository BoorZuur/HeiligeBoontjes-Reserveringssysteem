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
$teams = [];

// get club info
$query = "SELECT * FROM employees WHERE id = $id";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$employee = mysqli_fetch_assoc($result);
mysqli_close($db);

if (mysqli_num_rows($result) != 1) {
    header('Location: index.php');
    exit();
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details - Medewerkers | Heilige Bonen</title>
    <link rel="stylesheet" href="../../css/bulma.css">
</head>
<body>

<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Medewerkers > Details</p>
            <p class="subtitle"><?= htmlentities($employee['first_name'] . ' ' . $employee['last_name']) ?></p>
            <a class="button" href="index.php">&laquo; Ga terug</a>
        </div>
        <div>
            <a class="button my-2" href="../../logout.php">Uitloggen</a>
            <p class="subtitle"> Hallo, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>
    </div>
</header>

<main class="container">
    <section class="section content">
        <ul>
            <li>Telefoonnummer: <?= htmlentities($employee['phone']) ?></li>
            <li>Email: <?= htmlentities($employee['email']) ?></li>
            <li>Rol: <?= htmlentities($employee['role']) ?></li>
        </ul>
    </section>
</main>
</body>
</html>
