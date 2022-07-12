<?php

namespace Tests\Unit;

use App\Classes\CheckStock;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_exceeded_stock_on_hand(){
        //get the stock on hand data
        $stocks = [
            ["quantity" => 13,"price" => 4.2,"value" => 54.6],
            ["quantity" => 10,"price" => 5,"value" => 50],
            ["quantity" => 15,"price" => 5,"value" => 75],
            ["quantity" => 3,"price" => 6,"value" => 18],
            ["quantity" => 2,"price" => 7,"value" => 14]
        ];
        $quantity = 41;
        $results = (new CheckStock())->handleStockCheck($quantity, $stocks);
        $this->assertEquals(expected:44, $quantity);
    }
}
