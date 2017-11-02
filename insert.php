<?php
//Gem input fra formular til variabler
$heading = $_GET['heading'];
$imgSrc = $_GET['imgSrc'];
$imgAlt = $_GET['imgAlt'];
$articleText = $_GET['articleText'];
$time = time();

//Forbind til databasen
require_once "connect.php";
//Redegør $statement med placeholder values
$statement = $dbh->prepare("INSERT INTO articles (imgSrc, imgAlt, heading, time, articleText) values(?, ?, ?, ?, ?) ");
//Bind variabler fra formularen til values
$statement->bindParam(1, $imgSrc);
$statement->bindParam(2, $imgAlt);
$statement->bindParam(3, $heading);
$statement->bindParam(4, $time);
$statement->bindParam(5, $articleText);
//Udfør $statement og gem info fra formularen til databasen
$statement->execute();
//Gå tilbage til forsiden
header("location: index.php");
?>