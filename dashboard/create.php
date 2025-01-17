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

if (isset($_POST['submit'])) {
    // Get form data
    $lastName = mysqli_escape_string($db, $_POST['lastName']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $date = mysqli_escape_string($db, $_POST['date']);
    $startTime = mysqli_escape_string($db, $_POST['startTime']);
    $endTime = mysqli_escape_string($db, $_POST['endTime']);
    $specialRequest = mysqli_escape_string($db, $_POST['specialRequest']);
    $allergies = mysqli_escape_string($db, $_POST['allergies']);
    $strippedPhone = str_replace('+', '', $phone);
    $strippedPhone = str_replace(' ', '', $strippedPhone);
    $errors = [];

    // Server-side validation
    if (empty($lastName)) {
        $errors['lastName'] = 'Achternaam is vereist';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Telefoonnummer is vereist';
    } elseif (!is_numeric($strippedPhone)) {
        $errors['phone'] = 'Telefoonnummer moet een nummer zijn';
    } elseif (strlen($phone) < 10) {
        $errors['phone'] = 'Telefoonnummer moet minstens 10 tekens zijn';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is vereist';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Ongeldige email';
    }
    if (!date_create_from_format('Y-m-d', $date)) {
        $errors['date'] = 'Ongeldige datum';
    }
    if (!date_create_from_format('H:i:s', $startTime)) {
        $errors['startTime'] = 'Ongeldige tijd';
    }
    if (!date_create_from_format('H:i:s', $endTime)) {
        $errors['endTime'] = 'Ongeldige tijd';
    }
    if (!in_array($specialRequest, ['none', 'vegan', 'vegetarian', 'halal'])) {
        $errors['specialRequest'] = 'Ongeldig verzoek';
    }
    if (empty($allergies)) {
        $allergies = null;
    }

// If data valid
    if (empty($errors)) {
        // store the new user in the database.
        $query = "INSERT INTO reservations (`table_id`, `last_name`, `phone`, `email`, `date`, `start_time`, `end_time`, `special_request`, `allergies`) 
                  VALUES (1, '$lastName', '$phone', '$email', '$date', '$startTime', '$endTime', '$specialRequest', '$allergies')";

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        mysqli_close($db);

        // If query succeeded
        if ($result) {
            // Redirect to login page
            header('Location: index.php');
            // Exit the code
            exit();
        }
    }
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bulma.css"/>
    <title>Aanmaken - Reserveringen | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Reserveringen > Aanmaken</p>
            <p class="subtitle">Nieuwe reservering aanmaken</p>
            <a class="button" href="index.php">&laquo; Ga terug</a>
        </div>
        <div>
            <a class="button my-2" href="/logout.php">Uitloggen</a>
            <p class="subtitle"> Hallo, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>
    </div>
</header>
<main>
    <section class="section">
        <div class="container content">
            <section class="columns">
                <form class="column is-6" action="" method="post">
                    <!-- Last name -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="lastName">Achternaam</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="lastName" type="text" name="lastName"
                                           value="<?= $lastName ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-person"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['lastName'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="phone">Telefoon</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="phone" type="text" name="phone"
                                           value="<?= $phone ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-phone"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['phone'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="email">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="email" type="text" name="email"
                                           value="<?= $email ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['email'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="date">Datum</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" id="date" type="date" name="date"
                                           value="<?= $date ?? '' ?>"/>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['date'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Start Time -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="startTime">Start Tijd</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" id="startTime" type="time" name="startTime" step="1"
                                           value="<?= $startTime ?? '' ?>"/>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['startTime'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- End Time -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="endTime">Eind Tijd</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" id="endTime" type="time" name="endTime" step="1"
                                           value="<?= $endTime ?? '' ?>"/>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['endTime'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Special Request -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="empty">Speciaal Verzoek</label>
                        </div>
                        <div class="field-body radios">
                            <label class="radio">
                                <input id="empty" type="radio" name="specialRequest" value="none" checked/>
                                Geen
                            </label>
                            <label class="radio">
                                <input type="radio" name="specialRequest" value="vegan"/>
                                Vegan
                            </label>
                            <label class="radio">
                                <input type="radio" name="specialRequest" value="vegetarian"/>
                                Vegetarian
                            </label>
                            <label class="radio">
                                <input type="radio" name="specialRequest" value="halal"/>
                                Halal
                            </label>
                            <p class="help is-danger">
                                <?= $errors['specialRequest'] ?? '' ?>
                            </p>
                        </div>
                    </div>

                    <!-- Allergies -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="allergies">Allergieën</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="allergies" type="text" name="allergies"
                                           value="<?= $allergies ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-allergies"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['allergies'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Reservering Aanmaken
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </section>
</main>
</body>
</html>
