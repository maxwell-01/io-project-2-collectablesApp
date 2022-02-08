<?php
require_once("functions.php");

if(count($_POST)>0){
    addBottle($dbPDO, $_POST['itemname'], $_POST['type'], $_POST['purchaselocation'], $_POST['purchasedate']);
}

$host = '127.0.0.1';
$username = 'root';
$password = 'password';
$dbName = 'collectorapp';

$PDO = connectDb($host, $username, $password, $dbName);
$bottles = getBottles($PDO);

?>
<!DOCTYPE html>
<html lang="en-GB">

<head>
    <title>Collector App</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="favicon.ico"/>
</head>

<body>

<header>

    <h1>Collector App</h1>

</header>

<main>
    <section class="new-item-form">
        <form method="POST" action="index.php">
            <h2>Add new item</h2>
            <label for="itemname">Name:</label><input type="text" id="itemname" name="itemname" required>
            <label for="type">Type:</label><input type="text" id="type" name="type" required>
            <label for="purchaselocation">Purchase location:</label><input type="text" id="purchaselocation" name="purchaselocation" required>
            <label for="purchasedate">Purchased date:</label><input type="date" id="purchasedate" name="purchasedate" required>
            <input type="submit" value="Add item" class="form-submit-button">
        </form>
    </section>

    <?= createBottlesHtml($bottles);?>
</main>

</body>
<footer>
    <div>
        <div class="footer-item">
            <a href="https://www.instagram.com/thehopefulhitchhikers/?hl=en" target="_blank">Instagram</a>
        </div>

        <div class="footer-item">
            <a href="https://www.linkedin.com/in/maxwellnewton/" target="_blank">LinkedIn</a>
        </div>

        <div class="footer-item">
            <a href="https://github.com/maxwell-01" target="_blank">GitHub</a>
        </div>
    </div>

</footer>
</html>