<?php
require_once("functions.php");
require_once("classes.php");

if(count($_POST)>0){
    $newItemObject = new BottlesAdd();
    $newItemObject->addBottle($_POST['itemname'], $_POST['type'], $_POST['purchaselocation'], $_POST['purchasedate']);
}

$bottlesObject = new BottlesView();
$bottles = $bottlesObject->showBottles();

?>
<html lang="en">
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
    <?= bottlesHtml($bottles);?>

</main>

</body>