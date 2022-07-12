<?php

namespace App\Http\Controllers;
use Storage;
use File;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Classes\CheckStock;

class StocksController extends Controller
{
    public function index()
    {
        //get the stock on hand data
        $path = public_path().'/stocks.json';
        $stocks = json_decode(file_get_contents($path), true); 

        return Inertia::render('Stocks/Index',['stocks' => $stocks]);
    }

    public function calculate(Request $request){
        $input = $request->all();

        //check stock total count
        $stockCountCheck = (new CheckStock())->handleStockTotalCount($input['quantity'], $input['stocks']);
        //dd($stockCountCheck);
        if(isset($stockCountCheck['quantity'])){
            return Inertia::render('Stocks/Index',['stocks.error' => 'Stocks request has exceeded the quantity on hand.']);
        }
        //access the CheckStock Class to handle the checking of stock on hand quantity
        $results = (new CheckStock())->handleStockCheck($input['quantity'], $input['stocks']);

        return Inertia::render('Stocks/Index',['stocks' => collect($results)->filter()->values()->toArray()]);
    }
}
