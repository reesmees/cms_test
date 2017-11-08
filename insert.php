<?php
session_start();
//Gem input fra formular til variabler
$heading = $_POST['heading'];
$imgSrc = $_POST['imgSrc'];
$imgName = $_POST['imgName'];
$imgAlt = $_POST['imgAlt'];
$articleText = $_POST['articleText'];
$time = time();
$username = $_SESSION['username'];

require_once "connect.php";
//Undersøg om der er eksisterende brugere med det indtastede brugernavn
$statement = $dbh->prepare("SELECT * FROM articles where imgName=?");
$statement->bindParam(1, $imgName);
$statement->execute();
//Hvis en bruger med brugernavnet ikke eksisterer, opret den nye bruger
if(empty($row=$statement->fetch())) {
    copy($imgSrc, 'img/'.$imgName.'');
    //Redegør $statement med placeholder values
    $statement = $dbh->prepare("INSERT INTO articles (imgName, imgAlt, heading, time, articleText, username) values(?, ?, ?, ?, ?, ?) ");
    //Bind variabler fra formularen til values
    $statement->bindParam(1, $imgName);
    $statement->bindParam(2, $imgAlt);
    $statement->bindParam(3, $heading);
    $statement->bindParam(4, $time);
    $statement->bindParam(5, $articleText);
    $statement->bindParam(6, $username);
    //Udfør $statement og gem info fra formularen til databasen
    $statement->execute();
    //Gå tilbage til forsiden
    header("location: index.php");
} else {
    //Hvis brugernavnet allerede er taget
    echo "<div class=\"error\">An image with that filename already exists, please choose a different filename.</div>";
}



//Forbind til databasen
require_once "connect.php";
?>