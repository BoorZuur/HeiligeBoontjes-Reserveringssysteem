<?php
/* This page is for admins only.
Here they can create, edit and delete users. */
require_once '../../config.php';

// this tells phpstorm that $db exists otherwise it will get mad at you
/** @var mysqli $db */
require_once (ROOT . 'includes/database.php');
session_start();

// check if user is logged in
if (!isset($_SESSION['login'])) {
    // Redirect if not logged in
    header('Location: ../../login.php');
    exit();
}

// check if user is admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../reservations.php');
}

$query = "SELECT * FROM users";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

mysqli_close($db);
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/bulma.css"/>
    <title>Users | Heilige Boontjes</title>
</head>
<body>
<header class="hero is-primary">
    <div class="hero-body is-flex is-justify-content-space-between">
        <div>
            <p class="title">Users</p>
            <p class="subtitle">Overview of all users</p>
        </div>
        <div>
            <a class="button my-2" href="../../logout.php">Logout</a>
            <p class="subtitle"> Hello, <?= htmlentities($_SESSION['first_name']) ?></p>
        </div>

    </div>
</header>

<main class="container">
    <section class="section">
        <div class="is-flex is-justify-content-center my-5">
            <a class="button is-info" href="create.php">Create new user</a>
        </div>
        <table class="table mx-auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th class="is-link">Details</th>
                <th class="is-warning">Edit</th>
                <th class="is-danger">Delete</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="7">&copy; My Collection</td>
            </tr>
            </tfoot>
            <tbody>
            <!-- Loop through all albums in the collection-->
            <?php foreach ($users as $index => $user) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlentities($user['first_name']) ?></td>
                    <td><?= htmlentities($user['last_name']) ?></td>
                    <td><?= htmlentities($user['email']) ?></td>
                    <td><a href="details.php?id=<?= $user['id'] ?>">Details</a></td>
                    <td><a class="has-text-warning" href="edit.php?id=<?= $user['id'] ?>">Edit</a></td>
                    <td><a class="has-text-danger" href="delete.php?id=<?= $user['id'] ?>">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
