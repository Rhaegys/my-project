<?php

namespace App\DataProcessing;

class YearlyYieldCalculator
{
    public function calculateYearlyYield($netWorth)
    {
        $symbolCount = 0; 
        foreach ($netWorth['Price'] as $value) {
            $symbolCount++;            
            if ($symbolCount == 24) {
                $buyingPrice = $value;
            }        
            if ($symbolCount == 1) {
                $sellingPrice = $value;
             }      
        }            
        $netWorth = (pow($sellingPrice / $buyingPrice, 1/2) - 1) * 100;
        $netWorth = round ($netWorth, 2);
        return $netWorth;
    }
}
