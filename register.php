<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register as a new user</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="register">
        <ul>
            <li><label for="username">Enter username: <span class="required">*</span></label>
                <input type="text" name="username" placeholder="Enter username here" />
            </li>
            <li><label for="password">Enter password: <span class="required">*</span></label>
                <input type="password" name="password" placeholder="Enter password here" />
            </li>
            <li><label for="password2">Conform password: <span class="required">*</span></label>
                <input type="password" name="password2" placeholder="Confirm password here" />
            </li>
            <li>
                <br>
                <input type="submit" value="Register" />
            </li>
        </ul>
    </form>
    <?php
    //Tjek om der er blevet indtastet noget overhovedet
    if(isset($_POST['username'])) {
        //Set indtastet information til variable
        $formUsername = $_POST['username'];
        $formPassword = $_POST['password'];
        $formPassword2 = $_POST['password2'];
        //Check om de to indtastede passwords er de samme
        if($formPassword != $formPassword2) {
            echo "Your entered passwords didn't match.";
        } else {
            require_once "connect.php";
            //Undersøg om der er eksisterende brugere med det indtastede brugernavn
            $statement = $dbh->prepare("SELECT * FROM users where dbUsername=?");
            $statement->bindParam(1, $formUsername);
            $statement->execute();
            //Hvis en bruger med brugernavnet ikke eksisterer, opret den nye bruger
            if(empty($row=$statement->fetch())) {
                $statement = $dbh->prepare("INSERT INTO users (dbUsername, dbPassword) values(?, ?)");
                $statement->bindParam(1, $formUsername);
                $statement->bindParam(2, $formPassword);
                $statement->execute();
                echo "Your user has been registered.";
                header("Refresh:3; url=index.php");
            } else {
                //Hvis brugernavnet allerede er taget
                echo "A user with that username already exists.";
            }
        }
    }?>
</body>
</html>