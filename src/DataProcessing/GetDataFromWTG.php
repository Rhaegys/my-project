<?php

namespace App\DataProcessing;

class GetDataFromWTG implements DataRetrieval
{
    public function getData()
    {
        $httpClient = new NativeHttpClient();
        $response = $httpClient->request('GET', 'https://api.worldtradingdata.com/api/v1/history?symbol=AAPL&sort=newest&api_token=WD4v4Hl3kEwTgHjK6LRkJWcZVVOH7D4i2TTRGNjNlAKw0u7ZJHZIrMZ6nUNW');
        $contents = $response->getContent();
        $data = json_decode($contents, true);
        return $data;
    }
    /*public function refactorData($data)
    {
        $data1=$data['Technical Analysis: MIDPOINT'];
        return $data1;
    }*/
}