<?php

$server   = "mariadb"; // El nombre del servicio mariadb definido en docker-compose.yml
$username = "root";
$password = "root";
$database = "pharmacy";

$mysqli = new mysqli($server, $username, $password, $database);

if ($mysqli->connect_error) {
    die('error'.$mysqli->connect_error);
}
?>
