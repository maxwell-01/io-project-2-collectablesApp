<?php
require_once("functions.php");

$dbPDO = connectDb('127.0.0.1:3306', 'root', 'password', 'collectorapp');
$bottles = getBottles($dbPDO);


?>
<html lang="en">

<body>

<main>

    <?= createbottlesHtml($bottles);?>

</main>

</body>