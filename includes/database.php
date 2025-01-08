<?php

// General settings
$host = "144.21.41.225";
$database = "heilige_boontjes";
$dbuser = "root";
$dbpassword = "z0s4PDwLYbvfOd";

$db = mysqli_connect($host, $dbuser, $dbpassword, $database)
or die("Error: " . mysqli_connect_error());
