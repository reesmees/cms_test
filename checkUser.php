<?php
$formUsername = $_POST['formUsername'];
$formPassword = $_POST['formPassword'];

require_once "connect.php";
//Hent bruger information fra databasen, hvis brugernavn matcher det brugernavn der bliver indtastet i login
$statement = $dbh->prepare("SELECT * FROM users WHERE dbUsername=?");
$statement->bindParam(1, $formUsername);
$statement->execute();
//Lav bruger information fra matchende brugernavne til associative array
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
//Vis hvis den indtastede bruger ikke findes i databasen, og send tilbage til index
if(empty($rows)) {
    echo "Kan ikke finde brugeren!";
    header( "Refresh:3; url=index.php");
} else {
    //Hvis der er brugere der matcher det indtastede brugernavn, test om passwordet matcher
    foreach($rows as $row) {
        if($row['dbPassword'] == $formPassword) {
            //Hvis passworded matcher, log brugeren ind
            session_start();
            $_SESSION['username'] = $formUsername;
            header("location: index.php");
        }
    }
    //Hvis passworded ikke matcher, fortæl det til brugeren og send dem tilbage til forsiden uden at logge ind
    echo "Ikke korrekt password!";
    header("Refresh:3; url=index.php");
}
$dbh = null;
?>