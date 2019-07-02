<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        /** @var \App\Entity\User $user */
        $data = $this->getUser()->getId();
        $httpClient = new NativeHttpClient();
        //$httpClient = new CurlHttpClient();
        //$response = $httpClient->request('GET', 'https://api.worldtradingdata.com/api/v1/history?symbol=AAPL&sort=newest&api_token=WD4v4Hl3kEwTgHjK6LRkJWcZVVOH7D4i2TTRGNjNlAKw0u7ZJHZIrMZ6nUNW');
        $response = $httpClient->request('GET', 'https://stooq.com/q/l/?s=wig&f=sd3t2ohlcv&h&e=csv');

        
        
        $contents = $response->getContent();





        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'data' => $data,
            'contents' => $contents,
        ]);
    }
}
