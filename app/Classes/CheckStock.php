<?php 
namespace App\Classes;

class CheckStock {
	public function handleStockCheck($number, $stocks)
    {
        //loop through stocks on hand and check the availability based on the requested amount it will loop through the record for first in first out, it will also output the updated amount calculations based on the updated quantity that was subtracted via the user number input
    	foreach($stocks as $key => $value) {
          if($value['quantity'] > $number) {
            
             $stocks[$key] = ['quantity' => $value['quantity'] - $number, 'price' => number_format($value['price'], 2, '.', ''), 'value' => number_format((($value['quantity'] - $number) * $value['price']),2) ];
             
             return $stocks;
          } else {
             $number -= $value['quantity'];
             $stocks[$key] = 0;
          }
       }

       return $stocks;
    }

    public function handleStockTotalCount($number, $stocks){
        //get the total sum of the stock quantity
        $total = collect($stocks)->sum('quantity');

        //check if the total stock quantity is greater than the requested amount, throw an error if requested amount is greater than the available stock on hand
        if($total < $number){
            return ['quantity' => 0, 'price' => 0, 'value' => 0 ];
        }

        return $stocks;
    }
}