<?php
    session_start();

    if(isset($_GET['logout']) && $_GET['logout'] == true) {
        //Logud
        session_destroy();
        header("location: index.php");
    } else {
        header("location: index.php");
    }
?>