<?php

namespace App\DataProcessing;

class RefactoredAlphaData implements DataRefactoring
{
    public function refactorData($rawPrices)
    {   
        $refactoredPricesArray = array();
        foreach ($rawPrices as $priceData) {
            $refactoredPrices = array();
            $monthsCount = 0;            
            foreach ($priceData['Technical Analysis: MIDPOINT'] as $key => $value) {
            $monthsCount++;
            if ($monthsCount < 25) {
                foreach ($value as $key1 => $value1) {                    
                    $date = explode(" ",$key);
                    $date = date('F, Y', strtotime($date[0]));
                    $refactoredPrices['Date'][] = $date;
                    $refactoredPrices['Price'][] = $value1;
                   }
                }
                $refactoredPricesArray[$priceData['Meta Data']['1: Symbol']] = $refactoredPrices;
                }
            }  
        return $refactoredPricesArray;  
    }
}
 