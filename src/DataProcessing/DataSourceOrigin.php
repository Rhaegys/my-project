<?php

namespace App\DataProcessing;

/**
 * This class defines which implementation of a Data Retrieval interface is used
 */
class DataSourceOrigin implements DataRetrieval
{
    /**
     * @var DataRetrieval[]
     */
    private $origins;

    public function __construct(DataRetrieval ...$origins)
    {
        $this->origins = $origins;
    }

    /**
     * This interface realisation depends on user variable  
     */

    public function getData($instruments, $userApiOrigin){        
        $originCount = 0;
        foreach ($this->origins as $origin) { 
            $originCount++;           
            try {
                if ($userApiOrigin == 'Alpha' && $originCount == 1) {
                    return $origin->getData($instruments, $userApiOrigin);
                }
                if ($userApiOrigin == 'WTG' && $originCount == 2) {
                    return $origin->getData($instruments, $userApiOrigin);
                }                
            } catch (\Exception $exception) {
                continue;
            }
        }
        throw new \Exception('User doesnt have API');

    }
}
 
