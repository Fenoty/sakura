<?php
$host = 'localhost';
$dbname = 'postgres';
$user = 'postgres';
$pass = '6882';
$port = 6882;

$dsn = "pgsql:host=".$host.";port=".$port.";dbname=".$dbname;
$options = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $options);


