<?php

namespace App\DataProcessing;

//use DataProcessing\DataRepository; 

interface DataProcessing 
{
    public function getData();
    public function refactorData($data);
}

class AV implements DataProcessing
{
    public function getData()
    {
        $httpClient = new NativeHttpClient();
        $response = $httpClient->request('GET', 'https://www.alphavantage.co/query?function=MIDPOINT&symbol=AAPL&interval=monthly&time_period=2&series_type=close&apikey=OR6OO04TI84ZWN3Z');
        $contents = $response->getContent();
        $data = json_decode($contents, true);
        return $data;
    } 
    public function refactorData($data)
    {
        $data1=$data['Technical Analysis: MIDPOINT'];
        return $data1;
    }
}

class WTG implements DataProcessing
{
    public function getData()
    {
        $httpClient = new NativeHttpClient();
        $response = $httpClient->request('GET', 'https://api.worldtradingdata.com/api/v1/history?symbol=AAPL&sort=newest&api_token=WD4v4Hl3kEwTgHjK6LRkJWcZVVOH7D4i2TTRGNjNlAKw0u7ZJHZIrMZ6nUNW');
        $contents = $response->getContent();
        $data = json_decode($contents, true);
        return $data;
    } 
    public function refactorData($data)
    {
        $data1=$data['Technical Analysis: MIDPOINT'];
        return $data1;
    }
}

