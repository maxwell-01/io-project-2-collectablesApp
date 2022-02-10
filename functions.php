<?php

function connectDb(string $host, string $user, string $password, string $dbName): PDO {
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}

function getBottles(PDO $pdo): array {
    $sql = "SELECT * FROM `bottles`";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
    return $results;
}

function addBottle(PDO $pdo, string $itemName, string $purchaseLocation, string $type, string $purchaseDate) {
    $sql = "INSERT INTO `bottles`(`itemname`, `purchaselocation`, `type`, `purchasedate`) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$itemName, $purchaseLocation, $type, $purchaseDate]);
}

function updateBottle(PDO $pdo, string $id, string $itemName, string $purchaseLocation,string $type, string $purchaseDate) {
    $sql = "UPDATE `bottles` SET `itemname` = ?, `purchaselocation` = ?, `type` = ?, `purchasedate` = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$itemName, $purchaseLocation, $type, $purchaseDate, $id]);
}

function validateDate(string $date, string $format = 'Y-m-d'): bool
{
    $dateObject = DateTime::createFromFormat($format, $date);
    return $dateObject && $dateObject->format($format) === $date;
}

function checkFormSubmission(array $postArray): array {
    if(empty($postArray['item-name']) ||  empty($postArray['purchase-location']) || empty($postArray['type']) || empty($postArray['purchase-date'])){
        return ['result' => false, 'message' => "Please enter a value for all fields."];
    }
    if(!validateDate($postArray['purchase-date'])){
        return ['result' => false, 'message' => "Please ensure you enter a date in the format yyyy-mm-dd."];
    }
    return ['result' => true, 'message' => ""];
}

function checkDropdownSubmission(array $postArray): array {
    $alcoholTypes = ["Rum", "Rye", "Vodka", "Whisky"];
    if(!in_array($postArray['type'], $alcoholTypes)) {
        return ['result' => false, 'message' => "You must choose one of the options for alcohol type."];
    }
    return ['result' => true, 'message' => ""];
}

function createBottlesHtml(array $allBottles, string $editCardId = null): string {

    //check to see whether this is an array of arrays and gracefully exits if not
    if (count($allBottles) == count($allBottles, COUNT_RECURSIVE))
    {
        return "createBottlesHtml function has not been passed an array within an array";
    }
    $bottlesHtml = "";
    foreach($allBottles as $bottle) {
        $bottlesHtml .=
            '<div class="bottleCard" id="dbId-'.$bottle['id'].'">';
        if(isset($editCardId) && $editCardId == $bottle['id']) {
            $bottlesHtml .='
                <form class="card-edit-button-form" method="POST" action="index.php#dbId-'.$bottle['id'].'">
                    <div class="card-outer">
                        <h3>Bottle number '.$bottle['id'].'</h3>
                        <div class="card-inner">
                            <div>
                                <label for="item-name">Bottle name</label>
                                <input type="text" id="item-name" name="item-name" value="'.$bottle['itemname'].'" required>
                            </div>
                            <div>
                                <label for="type">Type of alcohol</label>
                                <select id="type" name="type" required>
                                    <option selected hidden value="'.$bottle['type'].'">'.$bottle['type'].'</option>
                                    <option value="Rum">Rum</option>
                                    <option value="Rye">Rye</option>
                                    <option value="Vodka">Vodka</option>
                                    <option value="Whisky">Whisky</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-inner">
                            <div>
                                <label for="purchase-location">Purchase location</label>
                                <input type="text" id="purchase-location" name="purchase-location"  value="'.$bottle['purchaselocation'].'" required>
                            </div>
                            <div>
                                <label for="purchase-date">Purchased date</label>
                                <input type="date" id="purchase-date" name="purchase-date" value="'.$bottle['purchasedate'].'" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="'.$bottle['id'].'" name="id">
                    <input type="hidden" name="sql-call-type" value="update-item">
                    <input type="submit" value="Update item" class="form-submit-button">
                    <p class="error-message"><?=$errorMessage?></p>
                </form>';
        } else {
            $bottlesHtml .='
                <div class="card-details-parent">
                    <div>
                        <h3>Bottle number '.$bottle['id'].'</h3>
                        <form class="edit-initiate-form" method="GET" action="index.php#dbId-'.$bottle['id'].'">
                            <input type="hidden" name="editCardId" value="'.$bottle['id'].'">
                            <input type="image" alt="edit-button" src="edit.png" class="edit-button-on-card">
                        </form>
                    </div>
                    <div class="card-outer">
                        <div class="card-inner">
                            <div>
                                <h4>Bottle name</h4>
                                <p>'.$bottle['itemname'].'</p>
                            </div>
                            <div>
                                <h4>Type of alcohol</h4>
                                <p>'.$bottle['type'].'</p>
                            </div>
                        </div>
                        <div class="card-inner">
                            <div>
                                <h4>Purchase location</h4>
                                <p>'.$bottle['purchaselocation'].'</p>
                            </div>
                            <div>
                                <h4>Purchased date</h4>
                                <p>'.$bottle['purchasedate'].'</p>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        $bottlesHtml .= '</div>';
    }
    return $bottlesHtml;
}