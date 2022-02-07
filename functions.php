<?php
function bottlesHtml($allBottles): string {
    $unfriendlyNames = ["purchaselocation", "purchasedate"];
    $friendlyNames = ["Purchase location", 'Date purchased'];
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