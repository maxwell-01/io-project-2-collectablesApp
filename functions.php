<?php

function getCredentials($credentialFilename): array {
    // reads file and creates array with username at index 0 and password at index 1
    $lines = file(__DIR__.'/'.$credentialFilename);
    $credentials = [];
    foreach($lines as $line) {
        if (empty($line)) continue;
        $exploded = (explode(' ', $line));
        $credentials[] = str_replace("\n","",$exploded[1]);
    }
    return $credentials;
}

function connectDb(string $host, string $user, $password, string $dbName): PDO {
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}

function getBottles($pdo)
{
    $sql = "SELECT * FROM `bottles`";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    return $results;
}

function createbottlesHtml(array $allBottles): string {

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