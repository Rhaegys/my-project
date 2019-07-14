<?php

namespace App\DataProcessing;

use Symfony\Component\HttpClient\NativeHttpClient;

class DataFromAlpha implements DataRetrieval
{
    public function getData($instruments)
    {
        $httpClient = new NativeHttpClient();
        $data = array();                
        foreach ($instruments as $instrument) {            
            $response = $httpClient->request('GET', 'https://www.alphavantage.co/query?function=MIDPOINT&symbol='.$instrument->getSymbol().'&interval=monthly&time_period=2&series_type=close&apikey=OR6OO04TI84ZWN3Z');
            $contents = $response->getContent();
            $data[] = json_decode($contents, true);
        }
        return $data;
    }
}
