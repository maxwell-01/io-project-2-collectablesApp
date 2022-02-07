<?php
require_once("functions.php");
require_once("classes.php");
$bottlesObject = new BottlesView();
$bottles = $bottlesObject->showBottles();

?>
<html>
<body>

<main>
    <h1>Collector App</h1>
    <p>
        <?= bottlesHtml($bottles);?>
    </p>
</main>

</body>