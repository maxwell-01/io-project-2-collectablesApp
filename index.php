<?php
require_once("functions.php");
require_once("classes.php");
$bottles = new BottlesView();
?>
<html>
<body>

<main>
    <h1>Collector App</h1>
    <p>
        <?php print_r($bottles->showBottles());?>
    </p>
</main>

</body>