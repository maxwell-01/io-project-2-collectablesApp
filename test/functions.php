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
        $expectedOutput = '<div class="bottleCard"><h3>Park Rye</h3><h4>Type: </h4><p>Rye</p><h4>Purchase location: </h4><p>Canada</p><h4>Date purchased: </h4><p>2022-01-04</p></div>';
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
}