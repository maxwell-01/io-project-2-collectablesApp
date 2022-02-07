<?php
require_once("functions.php");
require_once("classes.php");
$bottlesObject = new BottlesView();
$bottles = $bottlesObject->showBottles();
$testinput = [
    ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04']
];
?>
<html>
<body>

<main>
    <section class="new-item-form">
        <form>
            <h2>Add new item</h2>
            <label for="itemname">Name: </label><input type="text" id="itemname" name="itemname">
            <label for="type">Type: </label><input type="text" id="type" name="type">
        </form>
    </section>
    <?= bottlesHtml($bottles);?>

</main>

</body>