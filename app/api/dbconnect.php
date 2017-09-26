<?php

$host = 'localhost';
$user = 'root';
$pass = 'pass';

$db_name = 'books';

$mysqli = new mysqli(
    $host,
    $user,
    $pass,
    $db_name
);