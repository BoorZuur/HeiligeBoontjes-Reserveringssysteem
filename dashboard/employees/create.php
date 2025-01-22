<?php
require_once '../../config.php';

// this tells phpstorm that $db exists otherwise it will get mad at you
/** @var mysqli $db */
require_once(ROOT . 'includes/database.php');
session_start();

if (!isset($_SESSION['login'])) {
    // Redirect if not logged in
    header('Location: ' . HTTP . 'login.php');
    exit();
}

// check if user is admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
}

if (isset($_POST['submit'])) {
    // Get form data
    $firstName = mysqli_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_escape_string($db, $_POST['lastName']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $role = mysqli_escape_string($db, $_POST['role']);
    $strippedPhone = str_replace('+', '', $phone);
    $strippedPhone = str_replace(' ', '', $strippedPhone);
    $errors = [];

    // Server-side validation
    if (empty($firstName)) {
        $errors['firstName'] = 'Voornaam is vereist';
    }
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
    if (empty($role)) {
        $errors['role'] = 'Rol is vereist';
    } elseif (!in_array($role, ['admin', 'staff'])) {
        $errors['role'] = 'Ongeldige rol';
    }

    // If data valid
    if (empty($errors)) {
        // create a secure password, with the PHP function password_hash()
        $randomPass = createRandomPass();
        $password = password_hash($randomPass, PASSWORD_DEFAULT);

        // store the new user in the database.
        $query = "INSERT INTO employees (`first_name`, `last_name`, `phone`, `email`, `password`, `role`) 
                  VALUES ('$firstName', '$lastName', '$phone', '$email', '$password', '$role')";

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        mysqli_close($db);

        // If query succeeded
        if ($result) {
            // stuur e-mail met info naar medewerker
            sendAccountEmail($email, $firstName, $lastName, $phone, $randomPass);
            // Redirect to login page
            header('Location: index.php');
            exit();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= HTTP ?>css/bulma.css"/>
    <title>Aanmaken - Medewerkers | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Medewerkers > Aanmaken</p>
            <p class="subtitle">Nieuwe medewerker aanmaken</p>
            <a class="button" href="index.php">&laquo; Ga terug</a>
        </div>
        <div>
            <a class="button my-2" href="<?= HTTP ?>logout.php">Uitloggen</a>
            <p class="subtitle"> Hallo, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>
    </div>
</header>
<main>
    <section class="section">
        <div class="container content">
            <section class="columns">
                <form class="column is-6" action="" method="post">

                    <!-- First name -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="firstName">Voornaam</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="firstName" type="text" name="firstName"
                                           value="<?= $firstName ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-person"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['firstName'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

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

                    <!-- Role -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="staff">Rol</label>
                        </div>
                        <div class="field-body radios">
                            <label class="radio">
                                <input id="staff" type="radio" name="role" value="staff" checked/>
                                Personeel
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="admin"/>
                                Administrator
                            </label>
                            <p class="help is-danger">
                                <?= $errors['role'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Nieuwe medewerker
                                registreren
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