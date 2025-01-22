<?php
// this tells phpstorm that $db exists otherwise it will get mad at you
/** @var mysqli $db */
require_once 'includes/database.php';
require_once 'config.php';
// required when working with sessions
session_start();

$login = false;

// check if Is user logged in?
if (isset($_SESSION['login'])) {
    $login = true;
}

if (isset($_POST['submit'])) {

    // Get form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = mysqli_escape_string($db, $_POST['password']);
    $errors = [];

    // Server-side validation
    if (empty($email)) {
        $errors['email'] = 'Email is vereist';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is vereist';
    }

    // If data valid
    if (empty($errors)) {
        // SELECT the user from the database, based on the email address.

        $query = "SELECT * FROM employees WHERE email = '$email'";

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        $user = mysqli_fetch_assoc($result);

        mysqli_close($db);
        // check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // Get user data from result
            $dbPass = $user['password'];
            // Check if the provided password matches the stored password in the database
            if (password_verify($password, $dbPass)) {
                // Store the user in the session
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['login'] = true;
                // Redirect to secure page
                header('Location: index.php');
                exit();
            } else {
                // Credentials not valid
                //error incorrect log in
                $errors['loginFailed'] = 'Onjuiste email of wachtwoord';
            }
        } else {
            // User doesn't exist
            //error incorrect log in
            $errors['loginFailed'] = 'Onjuiste email of wachtwoord';
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
    <script type="text/javascript" src="<?= HTTP ?>js/navbar.js"></script>
    <title>Log in | Heilige Boontjes</title>
</head>
<body>
<?php require_once ROOT . 'includes/html/nav.php'; ?>
<section class="section">
    <div class="container content">
        <h1 class="title">Log in</h1>
        <p class="subtitle">Deze inlogpagina is alleen voor medewerkers</p>
        <?php if ($login) { ?>
            <p>Je bent al ingelogd!</p>
            <p><a href="<?= HTTP ?>logout.php">Uitloggen</a> / <a href="<?= HTTP ?>dashboard/index.php">Naar
                    dashboard</a></p>
        <?php } else { ?>
            <section class="columns">
                <form class="column is-6" action="" method="post">

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

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="password">Wachtwoord</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="password" type="password" name="password"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                    <?php if (isset($errors['loginFailed'])) { ?>
                                        <div class="notification is-danger">
                                            <button class="delete"></button>
                                            <?= $errors['loginFailed'] ?>
                                        </div>
                                    <?php } ?>

                                </div>
                                <p class="help is-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-primary is-fullwidth" type="submit" name="submit">Inloggen
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        <?php } ?>
    </div>
</section>
</body>
</html>


