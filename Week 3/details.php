<?php
//Require database in this file
/** @var $db */
require_once "database.php";

//Retrieve the GET parameter from the 'Super global'
$personId = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM data WHERE id = " . $personId;
$result = mysqli_query($db, $query)
or die('Error: ' . $query . $db->error);
$person = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details - <?= $person['naam'] ?></title>
</head>
<body>
<h2><?= $person['naam'] ?></h2>

<ul>
    <li>Geboortedatum: <?= $person['geboortedatum'] ?></li>
    <li>E-mail: <?= $person['email'] ?></li>
    <li>Telefoonnummer: <?= $person['telefoonnummer'] ?></li>
    <li>Onderwerp van gesprek: <?= $person['onderwerp'] ?></li>
</ul>
<div>
    <a href="cle2.php">Go back to the list</a>
</div>
</body>
</html>