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

    <?= bottlesHtml($bottles);?>

</main>

</body>