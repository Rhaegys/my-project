<?php
declare(strict_types=1);
namespace App\DataProcessing;

class GetDataFromAlpha implements DataRetrieval
{
    public function getData()
    {
        $httpClient = new NativeHttpClient();
        $response = $httpClient->request('GET', 'https://www.alphavantage.co/query?function=MIDPOINT&symbol=AAPL&interval=monthly&time_period=2&series_type=close&apikey=OR6OO04TI84ZWN3Z');
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