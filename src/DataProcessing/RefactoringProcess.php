<?php

namespace App\DataProcessing;

/**
 * This class defines which implementation of a Data Refactroing interface is used
 */
class RefactoringProcess implements DataRefactoring
{
    /**
     * @var DataRefactoring[]
     */
    private $origins;

    public function __construct(DataRefactoring ...$origins)
    {
        $this->origins = $origins;
    }

    /**
     * This interface realisation depends on user variable  
     */
    public function refactorData($rawPrices, $userApiOrigin)
    {   
        $originCount = 0;
        foreach ($this->origins as $origin) { 
            $originCount++;           
            try {
                if ($userApiOrigin == 'Alpha' && $originCount == 1) {
                    return $origin->refactorData($rawPrices, $userApiOrigin);
                }
                if ($userApiOrigin == 'WTG' && $originCount == 2) {
                    return $origin->refactorData($rawPrices, $userApiOrigin);
                }                
            } catch (\Exception $exception) {
                continue;
            }
        }
        throw new \Exception('User doesnt have API');
    }
}
 