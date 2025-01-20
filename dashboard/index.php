<?php
// Hier komen de reserveringen te staan van de gasten
require_once '../config.php';

// this tells phpstorm that $db exists otherwise it will get mad at you
/** @var mysqli $db */
require_once(ROOT . 'includes/database.php');
session_start();

// check if employee is logged in
if (!isset($_SESSION['login'])) {
    // Redirect if not logged in
    header('Location: /login.php');
    exit();
}

$selectedDay = mysqli_escape_string($db, $_GET['day'] ?? 0);
$dateConverted = strtotime("+$selectedDay days");
$dateConverted = date("Y-m-d", $dateConverted);

$query = "SELECT * FROM reservations WHERE '$dateConverted' = date ORDER BY start_time";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$reservations = [];

while ($row = mysqli_fetch_assoc($result)) {
    $reservations[] = $row;
}
$reservationCount = count($reservations);
mysqli_close($db);
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bulma.css"/>
    <title>Reserveringen | Heilige Boontjes</title>
</head>
<body>
<?php require_once ROOT . 'includes/html/navDashboard.php'; ?>
<header class="hero is-primary">
    <div class="hero-body has-text-centered">
        <p class="title">Reserveringen</p>
        <p class="subtitle">Overzicht van alle reserveringen</p>
    </div>
</header>
<main class="container">
    <section class="section">
        <div class="is-flex is-gap-3 is-justify-content-center mb-5">
            <a class="button is-primary" href="index.php?day=0">Terug naar vandaag</a>
            <a class="button is-info" href="create.php">+ Nieuwe reservering aanmaken</a>
        </div>
        <div class="is-flex is-gap-2 is-justify-content-center is-align-items-center mb-1">
            <a class="button is-link" href="?day=<?= $selectedDay - 1 ?>">&laquo; Vorige dag</a>
            <span class="has-text-centered"><?= $dateConverted; ?></span>
            <a class="button is-link" href="?day=<?= $selectedDay + 1 ?>">Volgende dag &raquo;</a>
        </div>
        <table class="table mx-auto">
            <thead>
            <tr>
                <th>Time</th>
                <th>Naam</th>
                <th>Tafel</th>
                <th>Email</th>
                <th class="has-text-link">Details</th>
                <th class="has-text-warning">Bewerken</th>
                <th class="has-text-danger">Verwijderen</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="7"><?= $reservationCount ?> Resultaten</td>
            </tr>
            </tfoot>
            <tbody>
            <!-- Loop through all albums in the collection-->
            <?php foreach ($reservations as $index => $reservation) { ?>
                <tr>
                    <td><?= htmlentities($reservation['start_time']) ?></td>
                    <td><?= htmlentities($reservation['last_name']) ?></td>
                    <td><?= htmlentities($reservation['table_id']) ?></td>
                    <td><?= htmlentities($reservation['email']) ?></td>
                    <td class="has-background-link-dark"><a class="has-text-link"
                                                            href="details.php?id=<?= $reservation['id'] ?>">Details</a>
                    </td>
                    <td class="has-background-warning-dark"><a class="has-text-warning"
                                                               href="edit.php?id=<?= $reservation['id'] ?>">Bewerken</a>
                    </td>
                    <td class="has-background-danger-dark"><a class="has-text-danger"
                                                              href="delete.php?id=<?= $reservation['id'] ?>">Verwijderen</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
