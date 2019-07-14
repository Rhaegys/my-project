<?php

namespace App\DataProcessing;

use Symfony\Component\HttpClient\NativeHttpClient;

class DataFromWTG implements DataRetrieval
{
    public function getData($instruments)
    {
        $httpClient = new NativeHttpClient();
        $data = array();  
        foreach ($instruments as $instrument) {            
            $response = $httpClient->request('GET', 'https://api.worldtradingdata.com/api/v1/history?symbol='.$instrument->getSymbol().'&sort=newest&date_from=2017-07-01&api_token=WD4v4Hl3kEwTgHjK6LRkJWcZVVOH7D4i2TTRGNjNlAKw0u7ZJHZIrMZ6nUNW');
            $contents = $response->getContent();
            $data[] = json_decode($contents, true);
        }        
        return $data;
    }    
}
