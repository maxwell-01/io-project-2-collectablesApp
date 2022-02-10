<?php
require_once("functions.php");

$host = '127.0.0.1';
$username = 'root';
$password = 'password';
$dbName = 'collectorapp';

$PDO = connectDb($host, $username, $password, $dbName);

$errorMessage = "";
if(isset($_POST['sql-call-type'])){
    if($_POST['sql-call-type'] == "new-item") {
        $formSubmissionCheck = checkFormSubmission($_POST);
        $dropdownSubmissionCheck = checkDropdownSubmission($_POST);
        if ($formSubmissionCheck['result'] && $dropdownSubmissionCheck['result']) {
            addBottle($PDO, $_POST['item-name'], $_POST['purchase-location'], $_POST['type'], $_POST['purchase-date']);
        } else $errorMessage = $formSubmissionCheck['message'] .' '. $dropdownSubmissionCheck['message'];
    }
    if($_POST['sql-call-type'] == "update-item") {
        $formSubmissionCheck = checkFormSubmission($_POST);
        $dropdownSubmissionCheck = checkDropdownSubmission($_POST);
        if ($formSubmissionCheck['result'] && $dropdownSubmissionCheck['result']) {
            updateBottle($PDO, $_POST['id'], $_POST['item-name'], $_POST['purchase-location'], $_POST['type'], $_POST['purchase-date']);
        } else $errorMessage = $formSubmissionCheck['message'] .' '. $dropdownSubmissionCheck['message'];
    }
}

$editCardId = '';
if(isset($_GET['editCardId'])) {
    $editCardId = $_GET['editCardId'];
}
$bottles = getBottles($PDO);
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title>Collector App</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="favicon.ico"/>
</head>
<body>
    <header>
        <h1>Collector App</h1>
    </header>
    <main>
        <section class="new-item-form-section">
            <form method="POST" action="index.php">
                <h2>Add a new bottle to your collection</h2>
                <div class="form-outer">
                    <div class="form-inner">
                        <div>
                            <label for="item-name">Bottle name</label>
                            <input type="text" id="item-name" name="item-name" required>
                        </div>
                        <div>
                            <label for="type">Type of alcohol</label>
                            <select id="type" name="type" required>
                                <option value="Rum">Rum</option>
                                <option value="Rye">Rye</option>
                                <option value="Vodka">Vodka</option>
                                <option value="Whisky">Whisky</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inner">
                        <div>
                            <label for="purchase-location">Purchase location</label>
                            <input type="text" id="purchase-location" name="purchase-location" required>
                        </div>
                        <div>
                            <label for="purchase-date">Purchased date</label>
                            <input type="date" id="purchase-date" name="purchase-date" required>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="sql-call-type" value="new-item">
                <input type="submit" value="Add item" class="form-submit-button">
                <p class="error-message"><?=$errorMessage?></p>
            </form>
        </section>

        <section class="item-cards-section">
            <h2>Currently in your collection...</h2>
            <div class="bottlesParent">
                <?= createBottlesHtml($bottles, $editCardId);?>
            </div>
        </section>
    </main>
</body>
</html>