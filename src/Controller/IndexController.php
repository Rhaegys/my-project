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
        $userId = $this->getUser()->getId();
        
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'data' => $userId,
        ]);
    }
}
