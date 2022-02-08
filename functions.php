<?php

function connectDb(string $host, string $user, $password, string $dbName): PDO {
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}

function getBottles($pdo): array
{
    $sql = "SELECT * FROM `bottles`";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    return $results;
}

function addBottle(object $pdo, string $itemName, string $purchaseLocation,string $type, string $purchaseDate)
{
    $sql = "INSERT INTO `bottles`(itemname, purchaselocation, type, purchasedate) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$itemName, $purchaseLocation, $type, $purchaseDate]);
}

function createBottlesHtml(array $allBottles): string {

    //check to see whether this is an array of arrays and gracefully exits if not
    if (count($allBottles) == count($allBottles, COUNT_RECURSIVE))
    {
        return "bottlesHTML function has not been passed an array within an array";
    }
    $unfriendlyNames = ["purchaselocation", "type", "purchasedate"];
    $friendlyNames = ["Purchase location", "Type", "Date purchased"];
    $bottlesHtml = "";
    foreach($allBottles as $bottle) {
        $bottlesHtml .= '<div class="bottleCard">';
        $bottlesHtml .= "<h2>" . $bottle['itemname'] . "</h2>";
        foreach($bottle as $detailName => $detailValue){
            if($detailName == 'itemname' || $detailName == 'id') {
                continue;
            }
            $bottlesHtml .= "<p>" . $detailName . ": " . $detailValue . "</p>";
        }
        $bottlesHtml .= "</div>";
    }
    $bottlesHtml = str_replace($unfriendlyNames, $friendlyNames, $bottlesHtml);
    return $bottlesHtml;
}