<?php

namespace App\DataProcessing;

/**
 * This class calculates the worth of all of user's instruments by month
 */
class WorthCalculator
{
    public function calculateNetWorth($assetsWorth)
    {
        $netWorth = array();
        $symbolCount = 0;  
        foreach ($assetsWorth as $item) {
            $symbolCount++;
            $monthCount = 0;
            $netWorth['Date'] = $item['Date'];
            foreach ($item['Price'] as $key => $value) {
                $monthCount++;
                if ($symbolCount == 1) {
                    $netWorth['Price'][$monthCount] = $value;
                } else {
                    $netWorth['Price'][$monthCount] = $netWorth['Price'][$monthCount] + $value;
                }                 
            }
        }
        return $netWorth;
    }
}
