<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS Test</title>
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
</head>
<body>
    <div class="container">
    <header><img src="img/p3_protag.jpg" alt="En side om mine yndlings spil"></header>
    <nav>
        <ul>
            <a href="#"><li>Home</li></a>
            <a href="#"><li>Log in</li></a>
            <a href="#"><li>About</li></a>
            <a href="#"><li>Contact</li></a>
        </ul>
    </nav>
    <main>
    <?php 
            //Giv mulighed for at lave nye blogindlæg hvis brugeren er logget in
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
        <article>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form">
                    <input id="heading" type="text" name="heading" placeholder="Heading"> 
                </div>
                <br>
                <div class="form">
                    <input id="imgSrc" type="text" name="imgSrc" placeholder="Image url">
                </div>
                <br>
                <div class="form">
                    <input id="imgName" type="text" name="imgName" placeholder="Image name">
                </div>
                <br>
                <div>
                    <input id="imgAlt" type="text" name="imgAlt" placeholder="Image alt text">
                </div>
                <br>
                <div>
                    <input id="articleText" type="text" name="articleText" placeholder="Article text">
                </div>
                <br>
                <input type="submit" value="Submit" content="Submit">
            </form>
            <?php
            if(!empty($_POST['heading'])){
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

            }
            ?>
        </article>
                <?php } ?>
        <?php include "fetchDB.php"; ?>
    </main>
    <aside>
        <div class="login">
            <?php 
            //Hvis brugeren er logget ind, vis dem at de er det, og giv mulighed for at logge ud
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                    <h4>Velkommen <?php echo $_SESSION['username']; ?>!</h4>
                    <a href="logout.php?logout=true">Log ud</a>
                    <?php
                    //Hvis brugeren ikke er logget ind, vis log ind boks
                } else { ?>
                    <form action="checkUser.php" method="post">
                        <label for="user">Username:</label>
                        <input type="text" id="user" name="formUsername" placeholder="Username">
                        <label for="pass">Password:</label>
                        <input type="password" id="pass" name="formPassword" placeholder="Password">
                        <input type="submit" value="Log in">
                        <a href="register.php">Register here</a>
                    </form>
                    <?php 
                }
            ?>
        </div>
    </aside>
    <footer>
        <h6>What, why are you even looking down here? Go back up to my amazingly pretty, and incredibly functional site, look at that instead. There really isn't anything in this footer of interest.</h6>
    </footer>
    </div>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script>
    window.sr = ScrollReveal({reset: true});
    sr.reveal(".blogpost");
    </script>
</body>
</html>