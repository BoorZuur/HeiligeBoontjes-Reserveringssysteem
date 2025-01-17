<?php
require_once "../includes/database.php";
/** @var mysqli $db */

$query = "SELECT *
          FROM planning_system.reservations";

$result = mysqli_query($db, $query);

if ($result) {
    $reservations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Overzicht van alle reserveringen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<section class="container">
    <div class="content">
        <h1 class="title">Alle reserveringen</h1>

        <a href="select-date.php" class="button is-link">Nieuwe reservering</a>

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Datum</th>
                <th>Start</th>
                <th>Eind</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $index => $reservation) {
                ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $reservation['description']; ?></td>
                    <td><?= $reservation['date']; ?></td>
                    <td><?= $reservation['start_time']; ?></td>
                    <td><?= $reservation['end_time']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
