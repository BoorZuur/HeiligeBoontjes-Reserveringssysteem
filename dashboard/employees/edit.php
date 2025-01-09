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
$role = '';
$errors = [];

// get player info from db
if (!isset($_POST['submit'])) {
    $query = "SELECT * FROM employees WHERE id = $id";

    $result = mysqli_query($db, $query)
    or die('Error ' . mysqli_error($db) . ' with query ' . $query);

    $employee = mysqli_fetch_assoc($result);
    mysqli_close($db);

    if (mysqli_num_rows($result) != 1) {
        header('Location: index.php');
        exit();
    }

    $first_name = $employee['first_name'];
    $last_name = $employee['last_name'];
    $phone = $employee['phone'];
    $email = $employee['email'];
    $role = $employee['role'];
}

// update db if form is sent
if (isset($_POST['submit'])) {
    $id = mysqli_escape_string($db, $_POST['id']);
    $first_name = mysqli_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_escape_string($db, $_POST['last_name']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $role = mysqli_escape_string($db, $_POST['role']);
    $strippedPhone = str_replace('+', '', $phone);
    $strippedPhone = str_replace(' ', '', $strippedPhone);

    // validation
    if (empty($first_name)) {
        $errors['first_name'] = 'Voornaam is vereist';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'Achternaam is vereist';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Telefoonnummer is vereist';
    } elseif (!is_numeric($strippedPhone)) {
        $errors['phone'] = 'Telefoonnummer moet een nummer zijn';
    } elseif (strlen($phone) < 10) {
        $errors['phone'] = 'Telefoonnummer moet minstens 10 tekens';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is vereist';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Ongeldige e-mailadres';
    }
    if (empty($role)) {
        $errors['role'] = 'Rol is vereist';
    } elseif (!in_array($role, ['admin', 'staff'])) {
        $errors['role'] = 'Ongeldige rol';
    }
    if (empty($id)) {
        header('Location: index.php');
        exit();
    }

    // db update
    if (empty($errors)) {
        $query = "UPDATE employees SET first_name = '$first_name', last_name = '$last_name',
                 phone = '$phone', email = '$email', role = '$role' WHERE id = $id";

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        mysqli_close($db);

        header('Location: index.php');
        exit();
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
    <link rel="stylesheet" href="../../css/bulma.css"/>
    <title>Bewerken - Medewerkers | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Medewerkers > Bewerken</p>
            <p class="subtitle">Medewerker bewerken</p>
            <a class="button" href="index.php">&laquo; Ga terug</a>
        </div>
        <div>
            <a class="button my-2" href="../../logout.php">Uitloggen</a>
            <p class="subtitle"> Hallo, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>
    </div>
</header>
<main>
    <section class="section">
        <div class="container content">
            <div class="columns">
                <form class="column is-6" action="" method="post">
                    <!-- First name -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="first_name">Voornaam</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="first_name" type="text" name="first_name"
                                           value="<?= $first_name ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-person"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['first_name'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Last name -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="last_name">Achternaam</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="last_name" type="text" name="last_name"
                                           value="<?= $last_name ?? '' ?>"/>
                                    <span class="icon is-small is-left"><i class="fas fa-person"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['last_name'] ?? '' ?>
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
                                <input id="staff" type="radio" name="role" value="staff" <?php if ($role == 'staff') {
                                    echo 'checked';
                                } ?>/>
                                Personeel
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="admin" <?php if ($role == 'admin') {
                                    echo 'checked';
                                } ?>/>
                                Administrator
                            </label>
                            <p class="help is-danger">
                                <?= $errors['role'] ?? '' ?>
                            </p>
                        </div>
                    </div>

                    <!--Pass ID in post-->
                    <input type="hidden" name="id" value="<?= $id ?>"/>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Opslaan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
</html>
