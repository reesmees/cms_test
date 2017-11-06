<?php
session_start();
//Gem input fra formular til variabler
$heading = $_POST['heading'];
$imgSrc = $_POST['imgSrc'];
$imgAlt = $_POST['imgAlt'];
$articleText = $_POST['articleText'];
$time = time();
$username = $_SESSION['username'];

//Forbind til databasen
require_once "connect.php";
//Redegør $statement med placeholder values
$statement = $dbh->prepare("INSERT INTO articles (imgSrc, imgAlt, heading, time, articleText, username) values(?, ?, ?, ?, ?, ?) ");
//Bind variabler fra formularen til values
$statement->bindParam(1, $imgSrc);
$statement->bindParam(2, $imgAlt);
$statement->bindParam(3, $heading);
$statement->bindParam(4, $time);
$statement->bindParam(5, $articleText);
$statement->bindParam(6, $username);
//Udfør $statement og gem info fra formularen til databasen
$statement->execute();
//Gå tilbage til forsiden
header("location: index.php");
?>