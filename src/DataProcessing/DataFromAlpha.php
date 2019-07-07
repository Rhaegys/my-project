<?php

namespace App\DataProcessing;

use Symfony\Component\HttpClient\NativeHttpClient;

class DataFromAlpha implements DataRetrieval
{
    public function getData()
    {
        $httpClient = new NativeHttpClient();
        $response = $httpClient->request('GET', 'https://www.alphavantage.co/query?function=MIDPOINT&symbol=AAPL&interval=monthly&time_period=2&series_type=close&apikey=OR6OO04TI84ZWN3Z');
        $contents = $response->getContent();
        $data = json_decode($contents, true);
        return $data;
    }
}
