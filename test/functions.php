<?php

require '../functions.php';
use PHPUnit\Framework\TestCase;

class Functions extends TestCase
{
    public function testSuccessBottlesHtml()
    {
        $testinput = [
            ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04']
        ];
        $expectedOutput = '<div class="bottleCard"><h2>Park Rye</h2><p>Type: Rye</p><p>Purchase location: Canada</p><p>Date purchased: 2022-01-04</p></div>';
        $actualOutput = createbottlesHtml($testinput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testFailuresBottlesHtml()
    {
        $testinput = ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04'];
        $expectedOutput = "bottlesHTML function has not been passed an array within an array";
        $actualOutput = createbottlesHtml($testinput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testMalformedBottlesHtml()
    {
        $testinput = "banana"; //input is wrong data type
        $this->expectException(TypeError::class);
        $output = createbottlesHtml($testinput);
    }
}