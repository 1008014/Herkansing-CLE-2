<?php
require_once "database.php";

$correct = true;

if(isset($_POST['verzenden'])) {
    $naam = $_POST['naam'];
    $onderwerp = $_POST['onderwerp'];
    $nummer = $_POST['nummer'];
    $datum = $_POST['datum'];
    $mail = $_POST['mail'];
}

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

$query = "SELECT * FROM data";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$personalDatas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $personalDatas[] = $row;
}

//Close connection
mysqli_close($db);

//validation
if ($naam == "") {
    echo "<br>Er is niets ingevuld 'Naam'.";
    $correct = false;
} elseif (is_numeric($naam)) {
    echo "<br>Er is een getal ingevuld. Dit is niet mogelijk.";
    $correct = false;
}

if ($datum == "") {
    echo "<br>Er is niets ingevuld 'Geboortedatum'.";
    $correct = false;
}
if ($mail == "") {
    echo "<br>Er is niets ingevuld 'E-mail'.";
    $correct = false;
}
if ($nummer == "") {
    echo "<br>Er is niets ingevuld 'Telefoonnummer'.";
    $correct = false;
}
if ($onderwerp == "") {
    echo "<br>Er is niets ingevuld 'onderwerp'.";
    $correct = false;
}

if ($correct == false) {
    echo "<br> Het formulier kon niet verzonden worden. Controleer op fouten.";
} else {
    echo "<br><br> Het formulier is verzonden!<br>";
    echo "Naam: " . $_POST['naam'] . "<br>";
    echo "Onderwerp: " . $_POST['onderwerp'] . "<br>";
    echo "<br>";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>sprint 1</title>

</head>

<body>

<style type="text/css">
    label {
        float: left;
        display: block;
        width: 150px;
    }
    input {
        display: block;
    }
    table, th, td {
        border: 1px solid black;
    }
    table.center {
        margin-left: auto;
        margin-right: auto;
    }
</style>

<!-- Invulformulier -->
<form method="post" action="">
    <label>Naam</label>
    <input type="text" name="naam">

    <label>Geboortedatum</label>
    <input type="text" name="datum">

    <label>E-mail</label>
    <input type="text" name="mail">

    <label>Telefoonnummer</label>
    <input type="text" name="nummer">

    <label>Onderwerp</label>
    <input type="text" name="onderwerp">
    <br>

    <input type="submit" name="verzenden" value="Verzenden">
</form>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Naam</th>
        <th>Geboortedatum</th>
        <th>E-mail</th>
        <th>Telefoonnummer</th>
        <th>Onderwerp</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($personalDatas as $personalData) { ?>
        <tr>
            <td><?= $personalData['id'] ?></td>
            <td><?= $personalData['Naam'] ?></td>
            <td><?= $personalData['Geboortedatum'] ?></td>
            <td><?= $personalData['E-mail'] ?></td>
            <td><?= $personalData['Telefoonnummer'] ?></td>
            <td><?= $personalData['Onderwerp'] ?></td>
            <td><a href="details.php?id=<?= $personalData['id'] ?>">Details</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<!-- Tabel met tijden -->
<table class="center">
    <tr>
        <th>Tijdvak</th>
        <th>Beschikbaarheid</th>
    </tr>
    <tr>
        <td>10.00 - 10.15</td>
        <td></td>
    </tr>
    <tr>
        <td>10.15 - 10.30</td>
        <td></td>
    </tr>
    <tr>
        <td>10.30 - 10.45</td>
        <td></td>
    </tr>
    <tr>
        <td>10.45 - 11.00</td>
        <td></td>
    </tr>
</table>
</body>
</html>