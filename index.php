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
        <section class="new-item-form-section">
            <form method="POST" action="index.php">
                <h2>Add a new bottle to your collection</h2>
                <div class="form-outer">
                    <div class="form-inner">
                        <label for="itemname">Bottle name</label>
                        <input type="text" id="itemname" name="itemname" required>
                        <label for="type">Type of alcohol</label>
                        <select id="type" name="type" required>
                            <option value="rum">Rum</option>
                            <option value="rye">Rye</option>
                            <option value="vodka">Vodka</option>
                            <option value="whisky">Whisky</option>
                        </select>
                    </div>
                    <div class="form-inner">
                        <label for="purchaselocation">Purchase location</label>
                        <input type="text" id="purchaselocation" name="purchaselocation" required>
                        <label for="purchasedate">Purchased date</label>
                        <input type="date" id="purchasedate" name="purchasedate" required>
                    </div>
                </div>
                <input type="submit" value="Add item" class="form-submit-button">
            </form>
        </section>

        <section class="item-cards-section">
            <h2>Currently in your collection...</h2>
            <?= createBottlesHtml($bottles);?>
        </section>

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