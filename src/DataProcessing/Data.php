<?php

namespace App\DataProcessing;

use Symfony\Component\HttpClient\NativeHttpClient;
use App\DataProcessing\DataProcessing; 

class Data
{
    private $sourceApi;
    private $ssd;
    public function __construct(DataProcessing $sourceApi,$ssd)
    {
        $this->sourceApi=$sourceApi;   
        $this->ssd=$ssd;     
    }    
}

