<?php
require_once("functions.php");

$credentials = getCredentials("dbCredentials.txt");
$dbPDO = connectDb('127.0.0.1:3306', $credentials[0], $credentials[1], 'collectorapp');
$bottles = getBottles($dbPDO);


?>
<html lang="en">

<body>

<main>

    <?= createbottlesHtml($bottles);?>

</main>

</body>