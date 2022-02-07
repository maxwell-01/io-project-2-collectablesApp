<?php
function bottlesHtml(array $allBottles): string {

    //check to see whether this is an array of arrays and gracefully exit if not
    if (count($allBottles) == count($allBottles, COUNT_RECURSIVE))
    {
        return "bottlesHTML function has not been passed an array within an array";
    }
    $unfriendlyNames = ["purchaselocation", "type", "purchasedate"];
    $friendlyNames = ["Purchase location", "Type", "Date purchased"];
    $bottleHtml = "";
    foreach($allBottles as $bottle) {
        $bottleHtml .= "<div class='bottleCard'>";
        $bottleHtml .= "<h2>" . $bottle['itemname'] . "</h2>";
        foreach($bottle as $detailName => $detailValue){
            if($detailName == 'itemname' || $detailName == 'id') {
                continue;
            }
            $bottleHtml .= "<p>" . $detailName . ": " . $detailValue . "</p>";
        }
        $bottleHtml .= "</div>";
    }
    $bottleHtml = str_replace($unfriendlyNames, $friendlyNames, $bottleHtml);
    return $bottleHtml;
}