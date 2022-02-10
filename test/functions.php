<?php

require '../functions.php';
use PHPUnit\Framework\TestCase;

class Functions extends TestCase
{
    public function testSuccessCreateBottlesHtmlAddBottle()
    {
        $testInput = [
            ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04']
        ];
        $expectedOutput =
            '<div class="bottleCard">
            <a class="anchor" id="dbId-1"></a>
                <div class="card-parent">
                    <div>
                        <h3>Bottle number 1</h3>
                        <form class="edit-initiate-form" method="GET" action="index.php#dbId-1">
                            <input type="hidden" name="editCardId" value="1">
                            <input type="image" alt="edit-button" src="edit.png" class="edit-button-on-card">
                        </form>
                    </div>
                    <div class="card-outer">
                        <div class="card-inner">
                            <div>
                                <h4>Bottle name</h4>
                                <p>Park Rye</p>
                            </div>
                            <div>
                                <h4>Type of alcohol</h4>
                                <p>Rye</p>
                            </div>
                        </div>
                        <div class="card-inner">
                            <div>
                                <h4>Purchase location</h4>
                                <p>Canada</p>
                            </div>
                            <div>
                                <h4>Purchased date</h4>
                                <p>2022-01-04</p>
                            </div>
                        </div>
                    </div>
                </div></div>';
        $actualOutput = createBottlesHtml($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testSuccessCreateBottlesHtmlEditBottle()
    {
        $testInputPostArray = [
            ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04']
        ];
        $testInputString = 1;
        $expectedOutput =
            '<div class="bottleCard">
            <a class="anchor" id="dbId-1"></a>
                <form class="card-edit-button-form" method="POST" action="index.php#dbId-1">
                    <div class="card-outer">
                        <h3>Bottle number 1</h3>
                        <div class="card-inner">
                            <div>
                                <label for="item-name">Bottle name</label>
                                <input type="text" id="item-name" name="item-name" value="Park Rye" required>
                            </div>
                            <div>
                                <label for="type">Type of alcohol</label>
                                <select id="type" name="type" required>
                                    <option selected hidden value="Rye">Rye</option>
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
                                <input type="text" id="purchase-location" name="purchase-location"  value="Canada" required>
                            </div>
                            <div>
                                <label for="purchase-date">Purchased date</label>
                                <input type="date" id="purchase-date" name="purchase-date" value="2022-01-04" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="1" name="id">
                    <input type="submit" value="Update item" class="form-submit-button">
                    <p class="error-message"><?=$errorMessage?></p>
                </form></div>';
        $actualOutput = createBottlesHtml($testInputPostArray, $testInputString);
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testFailuresCreateBottlesHtml()
    {
        $testInput = ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04'];
        $expectedOutput = "createBottlesHtml function has not been passed an array within an array";
        $actualOutput = createBottlesHtml($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testMalformedCreateBottlesHtml()
    {
        $testInput = "banana";
        $this->expectException(TypeError::class);
        $output = createBottlesHtml($testInput);
    }
    public function testSuccessValidateDateCorrectInput()
    {
        $testInput = "2017-12-04";
        $expectedOutput = true;
        $actualOutput = validateDate($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testSuccessValidateDateIncorrectInput()
    {
        $testInput = "2017-13-04";
        $expectedOutput = false;
        $actualOutput = validateDate($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testMalformedValidateDate()
    {
        $testInput = ["array"];
        $this->expectException(TypeError::class);
        $output = validateDate($testInput);
    }
    public function testSuccessCheckFormSubmissionPass()
    {
        $testInput = ['item-name' => 'Penderyn', 'type' => 'Whisky', 'purchase-location' => 'Cardiff', 'purchase-date' => '2017-12-12'];
        $expectedOutput = ['result' => true, 'message' => ""];
        $actualOutput = checkFormSubmission($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testSuccessCheckFormSubmissionNotAllFieldsSupplied()
    {
        $testInput =  ['item-name' => '','type' => 'Whisky', 'purchase-location' => 'Cardiff', 'purchase-date' => '2017-12-12'];
        $expectedOutput = ['result' => false, 'message' => "Please enter a value for all fields."];
        $actualOutput = checkFormSubmission($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testSuccessCheckFormSubmissionWrongDate()
    {
        $testInput = ['item-name' => 'Penderyn', 'type' => 'Whisky', 'purchase-location' => 'Cardiff', 'purchase-date' => '2017-13-12'];
        $expectedOutput = ['result' => false, 'message' => "Please ensure you enter a date in the format yyyy-mm-dd."];
        $actualOutput = checkFormSubmission($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testMalformedCheckFormSubmission()
    {
        $testInput = 1;
        $this->expectException(TypeError::class);
        $output = checkFormSubmission($testInput);
    }
    public function testSuccessCheckDropdownSubmission()
    {
        $testInput = ['item-name' => 'Penderyn', 'type' => 'Gin', 'purchase-location' => 'Cardiff', 'purchase-date' => '2017-12-12'];
        $expectedOutput = ['result' => false, 'message'=> "You must choose one of the options for alcohol type."];
        $actualOutput = checkDropdownSubmission($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testMalformedCheckDropdownSubmission()
    {
        $testInput = 1;
        $this->expectException(TypeError::class);
        $output = checkDropdownSubmission($testInput);
    }
}