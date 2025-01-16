<?php

// General settings
$host = "144.21.41.225";
$database = "planning_system";
$user = "root";
$password = "z0s4PDwLYbvfOd";

$db = mysqli_connect($host, $user, $password, $database) or die("Error: " . mysqli_connect_error());;
