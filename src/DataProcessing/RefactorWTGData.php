<?php

namespace App\DataProcessing;

class RefactorWTGData implements DataRefactoring
{
    public function refactorData($data)
    {
        $data1=$data['Technical Analysis: MIDPOINT'];
        return $data1;
    }    
}