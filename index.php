<?php
require_once("functions.php");
$dbPDO = connectDb('db', 'root', 'password', 'collectorapp');

if(count($_POST)>0){
    addBottle($dbPDO, $_POST['itemname'], $_POST['type'], $_POST['purchaselocation'], $_POST['purchasedate']);
}

$bottles = getBottles($dbPDO);

?>
<html lang="en">

<head>
    <title>Collector App</title>
</head>

<body>

<main>
    <section class="new-item-form">
        <form method="POST" action="index.php">
            <h2>Add new item</h2>
            <label for="itemname">Name:</label><input type="text" id="itemname" name="itemname" required>
            <label for="type">Type:</label><input type="text" id="type" name="type" required>
            <label for="purchaselocation">Purchase location:</label><input type="text" id="purchaselocation" name="purchaselocation" required>
            <label for="purchasedate">Purchased date:</label><input type="date" id="purchasedate" name="purchasedate" required>
            <input type="submit" value="Add item">
        </form>
    </section>

    <?= createBottlesHtml($bottles);?>
</main>

</body>
</html>