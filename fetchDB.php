<?php
//Brug connect.php én gang for at logge ind på databasen
require_once "connect.php";

//Vælg alt fra 'articles' tabellen
$statement = $dbh->prepare("SELECT * FROM articles");
$statement->execute();

//Lav hver row til et associative array og sæt det ind i article template
while ($row = $statement->fetch(PDO::FETCH_ASSOC)){ ?>
<article>
    <img src="img/<?php echo $row['imgSrc']; ?>.jpg" alt="<?php echo $row['imgAlt']; ?>">
    <h2><?php echo $row['heading']; ?></h2>
    <?php if(isset($row['username']) && !empty($row['username'])) { ?>
        <h3><?php echo $row['time'], " by ", $row['username']; ?></h3> <?php 
        } else { ?>
        <h3><?php echo $row['time'] ?> </h3> <?php
    } ?>
    <p><?php echo $row['articleText']; ?></p>
</article>
<?php
}
?>