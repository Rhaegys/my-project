<?php

namespace App\Controller;

use App\DataProcessing\Data; 
use App\DataProcessing\DataProcessing\AV; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\NativeHttpClient;

class ProcessDataController extends AbstractController
{
    /**
     * @Route("/process/data", name="process_data")
     */
    public function index()
    {
        $pup = new Data(new AV);
        $d1=$pup->getData();
        $contents=$pup->refactorData($d1);


        return $this->render('process_data/index.html.twig', [
            'controller_name' => 'ProcessDataController',
            'data' => $contents,
        ]);
    }
}
