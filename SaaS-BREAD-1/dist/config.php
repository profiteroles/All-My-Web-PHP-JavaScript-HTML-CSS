<?php

$dbHost = "localhost";
$dbUser = "saas_bread";
$dbPass ="saasPassword";
$dbName = "saas_bread";

$dsn = "mysql:host=$dbHost;dbname=$dbName";
$dbOptions = array(
    PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
);
/*
 * create a db on php my admin and copy that user accounts over to match the thing create db sql file.
 * next step is from tools deployment configurations add local create the folder in htdocs
 */