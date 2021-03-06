<?php
//Brug connect.php én gang for at logge ind på databasen
require_once "connect.php";

//Vælg alt fra 'articles' tabellen
$statement = $dbh->prepare("SELECT * FROM articles ORDER BY time DESC");
$statement->execute();

//Lav hver row til et associative array og sæt det ind i article template
while ($row = $statement->fetch(PDO::FETCH_ASSOC)){ ?>
<article class="blogpost">
    <img src="img/<?php echo $row['imgName']; ?>" alt="<?php echo $row['imgAlt']; ?>">
    <h2><?php echo $row['heading']; ?></h2>
    <?php if(isset($row['username']) && !empty($row['username'])) { ?>
        <h3><?php echo date(DATE_RFC850, $row['time']), " by ", $row['username']; ?></h3> <?php 
        } else { ?>
        <h3><?php echo date(DATE_RFC850, $row['time']); ?> </h3> <?php
    } ?>
    <p><?php echo $row['articleText']; ?></p>
</article>
<?php
// print "<pre>";
// print_r($row);
// print "</pre>";
}
?>