<?php

require '../functions.php';
use PHPUnit\Framework\TestCase;

class Functions extends TestCase
{
    public function testSuccessCreateBottlesHtml()
    {
        $testInput = [
            ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04']
        ];
        $expectedOutput = '<div class="bottleCard"><h3>Park Rye</h3><h4>Type</h4><p>Rye</p><h4>Purchase location</h4><p>Canada</p><h4>Date purchased</h4><p>2022-01-04</p></div>';
        $actualOutput = createBottlesHtml($testInput);
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
    public function testSuccessCheckDropdownSubmissionCorrectInput()
    {
        $testInput = ['item-name' => 'Penderyn', 'type' => 'Whisky', 'purchase-location' => 'Cardiff', 'purchase-date' => '2017-12-12'];
        $expectedOutput = ['result' => true, 'message'=> ""];
        $actualOutput = checkDropdownSubmission($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
    public function testSuccessCheckDropdownSubmissionWrongInput()
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