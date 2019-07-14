<?php

namespace App\DataProcessing;

/**
 * This class refactors data from WTG API into single data format
 */
class RefactoredWTGData implements DataRefactoring
{
    public function refactorData($rawPrices, $userApiOrigin)
    {
        $refactoredPricesArray = array();
        foreach ($rawPrices as $priceData) {            
            $refactoredPrices=array();
            $date = array();
            $date[0] = 0;
            $daysCount = 0;
            $monthsCount = 0;
            foreach ($priceData['history'] as $key => $value) {
                $daysCount++;
                $date[$daysCount]=date('F, Y', strtotime($key));
                if ($date[$daysCount] !== $date[$daysCount-1]) {
                    $monthsCount++;
                    if ($monthsCount < 25) {
                        $refactoredPrices['Date'][] = $date[$daysCount];
                        $refactoredPrices['Price'][] = $value['close'];
                        $refactoredPricesArray[$priceData['name']] = $refactoredPrices;                                                                       
                        }                                       
                    } 
                } 
            }            
        return $refactoredPricesArray;
    }    
}
