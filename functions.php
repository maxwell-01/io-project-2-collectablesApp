<?php

function connectDb(string $host, string $user, string $password, string $dbName): PDO {
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}

function getBottles($pdo): array {
    $sql = "SELECT * FROM `bottles`";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    return $results;
}

function addBottle(PDO $pdo, string $itemName, string $purchaseLocation,string $type, string $purchaseDate) {
    $sql = "INSERT INTO `bottles`(itemname, purchaselocation, type, purchasedate) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$itemName, $purchaseLocation, $type, $purchaseDate]);
}

function validateDate(string $date, string $format = 'Y-m-d'): bool
{
    $dateObject = DateTime::createFromFormat($format, $date);
    return $dateObject && $dateObject->format($format) === $date;
}

function checkFormSubmission(array $postArray): array {
    if(empty($postArray['item-name']) ||  empty($postArray['purchase-location']) || empty($postArray['type']) || empty($postArray['purchase-date'])){
        return [false, "Please enter a value for all fields."];
    }
    if(!validateDate($postArray['purchase-date'])){
        return [false, "Please ensure you enter a date in the format yyyy-mm-dd."];
    }
    $alcoholTypes = ["Rum", "Rye", "Vodka", "Whisky"];
    if(!in_array($postArray['type'], $alcoholTypes)) {
        return [false, "You must choose one of the options for alcohol type."];
    }
    return [true, ""];
}

function createBottlesHtml(array $allBottles): string {

    //check to see whether this is an array of arrays and gracefully exits if not
    if (count($allBottles) == count($allBottles, COUNT_RECURSIVE))
    {
        return "createBottlesHtml function has not been passed an array within an array";
    }
    $bottlesHtml = "";
    foreach($allBottles as $bottle) {
        $bottlesHtml .= '<div class="bottleCard">';
        $bottlesHtml .= '<h3>' . $bottle['itemname'] . '</h3>';
        foreach($bottle as $detailName => $detailValue){
            if($detailName == 'itemname' || $detailName == 'id') {
                continue;
            }
            $bottlesHtml .= '<h4>' . $detailName . ': '. '</h4>' . '<p>' . $detailValue . '</p>';
        }
        $bottlesHtml .= '</div>';
    }
    $unfriendlyNames = ["purchaselocation", "type", "purchasedate"];
    $friendlyNames = ["Purchase location", "Type", "Date purchased"];
    $bottlesHtml = str_replace($unfriendlyNames, $friendlyNames, $bottlesHtml);
    return $bottlesHtml;
}