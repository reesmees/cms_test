<?php

//Etabler variabler til at logge ind på databasen
$host = "localhost";
$dbName = "cms_test_db";
$dbUsername = "root";
$dbPassword = "";

//Log ind på MySQL database
try{
    $dbh = new PDO("mysql:dbname=$dbName;host:$host", $dbUsername, $dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Noget gik galt!: <br>";
    echo $e->getMessage();
}
?>