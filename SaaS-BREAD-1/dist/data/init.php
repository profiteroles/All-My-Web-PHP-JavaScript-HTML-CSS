
<?php

/**
 * Filename:init.php
 * Project: SaaS-Bread-1
 * Location: dist\data\
 * Author: EROL A'NIL
 * Created: 27/7/21
 * Description: This file creates the dab buser and dab for use in this basic crud /bread example
 * History: 2021/08/02 Added histry to the file as a demonstration
 */

try {


    $rootUser = "root";
    $rootPass = "";

    $dbCreationConnection = new PDO(

        "mysql:host=localhost;", $rootUser, $rootPass,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );

    //List of files with initialisation SQL code
    $files = ['db_drop.sql', 'db_create.sql', 'db_tables.sql'];

    //Execute each file in turn...
    foreach ($files as $filename) {
        echo "<h4>Executing $filename ...</h4>";
        $sql = file_get_contents($filename);
        $dbCreationConnection->exec($sql);
    }
} catch (PDOException $error) {
    echo "<h3>Error ... Stage 1</h3>";
    echo "<pre>";
    echo $sql . "<br>" . $error->getMessage();
    echo "</pre>";
    die(0);
}

//the seed data  for the db
$users = [
    [
        "id" => 1,
        "given_name" => 'Adrian',
        "family_name" => 'Gould',
        "email" => 'adrian@example.com',
        "age" => 45,
        "gender" => 'm',
        "location" => 'Wagga-Wagga, NSW, Australia',
    ],

    [
        "id" => 10,
        "given_name" => 'EROL',
        "family_name" => 'ANIL',
        "email" => 'erollooper@gmail.com',
        "age" => 32,
        "gender" => 'm',
        "location" => 'Perth, WA, Australia',
    ],
    [
        "id" => null,
        "given_name" => 'Jacques',
        "family_name" => 'd\'Carre',
        "email" => 'jacques@example.com',
        "age" => 0,
        "gender" => 'o',
        "location" => 'Paris, France',
    ],
    [
        "id" => null,
        "given_name" => 'Eileen',
        "family_name" => 'Dover',
        "email" => 'eileen@example.com',
        "age" => 0,
        "gender" => 'f',
        "location" => 'Dover, UK',
    ],

];

try {
    require_once "../config.php";
    $connection = new PDO($dsn, $dbUser, $dbPass, $dbOptions);
    echo "<h4>Adding Seed Users Data</h4>";

    foreach ($users as $aUser) {
        $id = $aUser['id'];
        $given_name = $aUser['given_name'];
        $family_name = $aUser['family_name'];
        $email = $aUser['email'];
        $age = $aUser['age'];
        $gender = $aUser['gender'];
        $location = $aUser['location'];

        $sql = "INSERT INTO users VALUES (:id, :given_name,"." :family_name,:email,:age,:gender,:location, now(), null)";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':given_name', $given_name, PDO::PARAM_STR);
        $statement->bindParam(':family_name', $family_name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();
    }

} catch (PDOException $error) {
    echo "<h3>Error ... Stage 2</h3>";
    echo "<pre>";
    echo $sql . "<br>" . $error->getMessage();
    echo "</pre>";
    die(0);
}

try {
    require_once "../config.php";
    $connection = new PDO($dsn, $dbUser, $dbPass, $dbOptions);
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $result = $statement->execute();
        $numUsers = $statement ->rowCount();

    echo "<h4>${numUsers} Users Added:</h4>";
    echo "<ul>";

    while ($aUser = $statement->fetch()) {
        $id = $aUser['id'];
        $given_name = $aUser['given_name'];
        $family_name = $aUser['family_name'];
        $email = $aUser['email'];
        $age = $aUser['age'];
        $gender = $aUser['gender'];
        $location = $aUser['location'];
        echo "<li>${given_name} ${family_name}</li>";
    }
    echo "</ul>";

} catch (PDOException $error) {
    echo "<h3>Error ... Stage 3</h3>";
    echo "<pre>";
    echo $sql . "<br>" . $error->getMessage();
    echo "</pre>";
}

