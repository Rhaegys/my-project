<?php

namespace App\DataProcessing;

class RefactoredAlphaData implements DataRefactoring
{
    public function refactorData($data)
    {   
        $data1=array();
        #$i=0;
        $data0=$data['Technical Analysis: MIDPOINT'];
        foreach ($data0 as $key => $value) {
            #$i++;
            foreach ($value as $key1 => $value1) {
                $value=$value1[1];

            }                        
        }
        return $data0;
    }    
}
