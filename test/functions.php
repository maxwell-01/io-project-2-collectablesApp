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
        $expectedOutput = '<div class="bottleCard"><h2>Park Rye</h2><p>Type: Rye</p><p>Purchase location: Canada</p><p>Date purchased: 2022-01-04</p></div>';
        $actualOutput = createBottlesHtml($testInput);
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testFailuresCreateBottlesHtml()
    {
        $testInput = ['id' => 1, 'itemname' => 'Park Rye', 'type' => 'Rye', 'purchaselocation' => 'Canada', 'purchasedate' => '2022-01-04'];
        $expectedOutput = "bottlesHTML function has not been passed an array within an array";
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