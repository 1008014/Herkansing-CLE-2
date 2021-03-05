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
$naamErr = $mailErr = $datumErr = $nummerErr = $onderwerpErr = "";
$naam = $mail = $datum = $nummer = $onderwerp = "";


if ($_SERVER["REQUEST_METHOD"]== "POST") {
    if (empty($_POST["naam"])) {
        $naamErr = "Naam is verplicht";
    }elseif (is_numeric($naam)) {
        echo "Er is een getal ingevuld. Dit is niet mogelijk.";
    }
    if (empty($_POST["mail"])) {
        $mailErr = "E-mail is verplicht";
    } else {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Er is een ongeldig E-mail ingevoerd";
        }
    }
    if (empty($_POST["datum"])) {
        $datumErr = "Geboortedatum is verplicht";
    }
    if (empty($_POST["nummer"])) {
        $nummerErr = "Telefoonnummer is verplicht";
    }
    if (empty($_POST["onderwerp"])) {
        $onderwerpErr = "Onderwerp is verplicht";

    }
}
?>

<!DOCTYPE html>
<html lang="nl">
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

<!-- fill-in form -->
<form method="post" action="">
    <table>
        <tr>
            <td>Naam:</td>
            <td><input type = "text" name = "naam">
                <span class = "error"> <?php echo $naamErr;?></span>
            </td>
        </tr>

        <tr>
            <td>E-mail: </td>
            <td><input type = "text" name = "mail">
                <span class = "error"> <?php echo $mailErr;?></span>
            </td>
        </tr>

        <tr>
            <td>Geboortedatum:</td>
            <td> <input type = "text" name = "datum">
                <span class = "error"><?php echo $datumErr;?></span>
            </td>
        </tr>

        <tr>
            <td>Telefoonnummer:</td>
            <td> <input type="text" name="nummer">
                <span class = "error"><?php echo $nummerErr;?></span>
            </td>
        </tr>

        <tr>
            <td>Onderwerp:</td>
            <td> <input type="text" name="onderwerp">
                <span class = "error"><?php echo $onderwerpErr;?></span>
            </td>
        </tr>

        <td>
            <input type = "submit" name = "submit" value = "Verzenden">
        </td>

    </table>
</form>

<!-- Table with personaldata -->
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

<!-- Table with times -->
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