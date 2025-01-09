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
    $query = "SELECT * FROM users WHERE id = $id";

    $result = mysqli_query($db, $query)
    or die('Error ' . mysqli_error($db) . ' with query ' . $query);

    $user = mysqli_fetch_assoc($result);
    mysqli_close($db);

    if (mysqli_num_rows($result) != 1) {
        header('Location: index.php');
        exit();
    }

    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $phone = $user['phone'];
    $email = $user['email'];
    $role = $user['role'];
}

// update db if form is sent
if (isset($_POST['submit'])) {
    $id = mysqli_escape_string($db, $_POST['id']);
    $first_name = mysqli_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_escape_string($db, $_POST['last_name']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $role = mysqli_escape_string($db, $_POST['role']);

    // validation
    if (empty($first_name)) {
        $errors['first_name'] = 'First Name is required';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'Last Name is required';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required';
    } elseif (!is_numeric($phone)) {
        $errors['phone'] = 'Phone number must be a number';
    } elseif (strlen($phone) < 10) {
        $errors['phone'] = 'Phone number must be 10 digits';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    if (empty($role)) {
        $errors['role'] = 'Role is required';
    } elseif (!in_array($role, ['admin', 'staff'])) {
        $errors['role'] = 'Invalid role';
    }
    if (empty($id)) {
        header('Location: index.php');
        exit();
    }

    // db update
    if (empty($errors)) {
        $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name',
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
    <title>Edit - Users | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Users > Edit</p>
            <p class="subtitle">Edit a user</p>
            <a class="button" href="index.php">&laquo; Go back to the list</a>
        </div>
        <div>
            <a class="button my-2" href="../../logout.php">Logout</a>
            <p class="subtitle"> Hello, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>
    </div>
</header>
<main>
<div class="container px-4">
    <h1 class="title mt-4">Edit</h1>
    <section class="columns">
        <form class="column is-6" action="" method="post">
            <!-- First name -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="first_name">First Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="first_name" type="text" name="first_name"
                                   value="<?= $first_name ?? '' ?>"/>
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
                    <label class="label" for="last_name">Last Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="last_name" type="text" name="last_name"
                                   value="<?= $last_name ?? '' ?>"/>
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
                    <label class="label" for="phone">Phone</label>
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
                        <input id="staff" type="radio" name="role" value="staff" <?php if ($role == 'staff') {echo 'checked';} ?>/>
                        Staff
                    </label>
                    <label class="radio">
                        <input type="radio" name="role" value="admin" <?php if ($role == 'admin') {echo 'checked';} ?>/>
                        Admin
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
                    <button class="button is-link is-fullwidth" type="submit" name="submit">Save</button>
                </div>
            </div>
        </form>
    </section>
    <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
</div>
</body>
</html>
