<?php
require_once("functions.php");

$host = 'db';
$username = 'root';
$password = 'password';
$dbName = 'collectorapp';

$PDO = connectDb($host, $username, $password, $dbName);
$bottles = getBottles($PDO);


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