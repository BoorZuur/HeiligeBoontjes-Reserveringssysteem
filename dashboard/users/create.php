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

if (isset($_POST['submit'])) {
    /** @var mysqli $db */

    // Get form data
    $firstName = mysqli_escape_string($db, $_POST['firstName']);
    $lastName = mysqli_escape_string($db, $_POST['lastName']);
    $phone = mysqli_escape_string($db, $_POST['phone']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = mysqli_escape_string($db, $_POST['password']);
    $role = mysqli_escape_string($db, $_POST['role']);
    $errors = [];

    // Server-side validation
    if (empty($firstName)) {
        $errors['firstName'] = 'First name is required';
    }
    if (empty($lastName)) {
        $errors['lastName'] = 'Last name is required';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Phone number is required';
    } elseif (is_numeric(strlen($phone)) < 10) {
        $errors['phone'] = 'Phone number must be 10 digits';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }
    if (empty($role)) {
        $errors['role'] = 'Role is required';
    } elseif (!in_array($role, ['admin', 'staff'])) {
        $errors['role'] = 'Invalid role';
    }

    // If data valid
    if (empty($errors)) {
        // create a secure password, with the PHP function password_hash()
        $password = password_hash($password, PASSWORD_DEFAULT);

        // store the new user in the database.
        $query = "INSERT INTO users (`first_name`, `last_name`, `phone`, `email`, `password`, `role`) 
                  VALUES ('$firstName', '$lastName', $phone, '$email', '$password', '$role')";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/bulma.css"/>
    <title>Create - Users | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Users > Create</p>
            <p class="subtitle">Create a new user</p>
            <a class="button" href="index.php">&laquo; Go back to the list</a>
        </div>
        <div>
            <a class="button my-2" href="../../logout.php">Logout</a>
            <p class="subtitle"> Hello, <?= htmlentities($_SESSION['first_name']) ?></p>
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
                            <label class="label" for="firstName">First name</label>
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
                            <label class="label" for="lastName">Last name</label>
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

                    <!-- Password -->
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="password">Password</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="password" type="password" name="password"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['password'] ?? '' ?>
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
                                <input id="staff" type="radio" name="role" value="staff"/>
                                Staff
                            </label>
                            <label class="radio">
                                <input type="radio" name="role" value="admin"/>
                                Admin
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
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Register new user
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
