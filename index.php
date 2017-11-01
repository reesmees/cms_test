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
    <header><img src="img/p3_protag.jpg" alt="Banner, en side om mine yndlings spil"></header>
    <nav>
        <ul>
            <a href="#"><li>Home</li></a>
            <a href="#"><li>Log in</li></a>
            <a href="#"><li>About</li></a>
            <a href="#"><li>Contact</li></a>
        </ul>
    </nav>
    <main>
        <?php include "fetchDB.php"; ?>
    </main>
    <aside>
        <div class="login">
            <p>Username:</p>
            <input type="text" name="username">
            <p>Password:</p>
            <input type="text" name="password">
            <br>
            <button type="button">Submit</button>
        </div>
    </aside>
    <footer>
        <h6>2017 copyright<h4>
    </footer>
    </div>
</body>
</html>