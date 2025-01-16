<?php

require_once "includes/functions.php";

//Get the current week from the GET or default to 0 (current week)
$selectedWeek = $_GET['week'] ?? 0;

//Retrieve the timestamp that belongs to the week that is active
$timestampWeek = strtotime("+$selectedWeek weeks");

//Get the weekdays that are part of the active week based on the timestamp
$weekDays = getWeekDays($timestampWeek);

//Get the month that belongs to the monday of that week
$monthOfWeek = date('F', $weekDays[0]['timestamp']);

//Get the year that belongs to the monday of that week
$yearOfWeek = date('Y', $weekDays[0]['timestamp']);

//The actual times visible in the calendar view
$rosterTimes = getRosterTimes();

//The events from the database that are in this week
$events = getEvents($weekDays[0]['fullDate'], $weekDays[6]['fullDate']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar weekview</title>
    <!-- From: https://codepen.io/kjellmf/pen/qgxyVJ -->
    <link href="css/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <style><?= getDynamicCSS($rosterTimes, $events); ?></style>
</head>
<body>

<div class="container">
    <div class="title">
        <a href="?week=<?= $selectedWeek - 1 ?>">Vorige week</a>
        <span><?= $monthOfWeek . ' ' . $yearOfWeek; ?></span>
        <a href="?week=<?= $selectedWeek + 1 ?>">Volgende week</a>
    </div>
    <div class="days">
        <div class="filler"></div>
        <div class="filler"></div>
        <?php foreach ($weekDays as $weekday) { ?>
            <div class="day<?= $weekday['current'] ? ' current' : ''; ?>">
                <?= $weekday['day'] . ' ' . $weekday['dayNumber']; ?>
            </div>
        <?php } ?>
    </div>
    <div class="content">
        <div class="filler-col"></div>
        <div class="col monday"></div>
        <div class="col tuesday"></div>
        <div class="col wednesday"></div>
        <div class="col thursday"></div>
        <div class="col friday"></div>
        <div class="col weekend saturday"></div>
        <div class="col weekend sunday"></div>
        <?php foreach ($rosterTimes as $index => $rosterTime) { ?>
            <div class="time row-roster-<?= $index + 1; ?>"><?= $rosterTime; ?></div>
            <div class="row row-roster-<?= $index + 1; ?>"></div>
        <?php } ?>
        <?php foreach ($events as $event) { ?>
            <a href="" class="event event-item-<?= $event['id']; ?>"><?= $event['description']; ?></a>
        <?php } ?>
    </div>
</div>
</body>
</html>
