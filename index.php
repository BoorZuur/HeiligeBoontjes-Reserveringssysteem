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
    <title>Reserveren | Heilige Boontjes</title>
</head>
<body>
<!-- TODO: reserveren form -->
</body>
</html>
