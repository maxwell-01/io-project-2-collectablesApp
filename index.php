<?php
require_once("functions.php");

$dbPDO = connectDb('db', 'root', 'password', 'collectorapp');
$bottles = getBottles($dbPDO);


?>
<html lang="en">

<head>
    <title>Collector App</title>
</head>

<body>

<main>

    <?= createBottlesHtml($bottles);?>

</main>

</body>
</html>