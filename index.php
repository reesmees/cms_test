<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS Test</title>
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
        <article>
            <form action="insert.php" method="get">
                <div class="form">
                    <input id="heading" type="text" name="heading" placeholder="Heading"> 
                </div>
                <br>
                <div class="form">
                    <input id="imgSrc" type="text" name="imgSrc" placeholder="Image filename">
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
        </article>

        <?php include "fetchDB.php"; ?>
    </main>
    <aside>
        <div class="login">
            <p>Username:</p>
            <input type="text" name="username" placeholder="Username">
            <p>Password:</p>
            <input type="password" name="password" placeholder="Password">
            <br>
            <button type="button">Log in</button>
        </div>
    </aside>
    <footer>
        <h6>2017 copyright</h6>
    </footer>
    </div>
</body>
</html>