<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        /** @var \App\Entity\User $user */
        $data = $this->getUser()->getId();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'data' => $data,
        ]);
    }
}
