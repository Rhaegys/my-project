<?php

namespace App\Controller;

<<<<<<< Updated upstream
use App\DataProcessing\Data; 
use App\DataProcessing\DataProcessing\AV; 
=======
//use App\DataProcessing\Data;
use App\DataProcessing\DataProcessing;

>>>>>>> Stashed changes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\NativeHttpClient;

class ProcessDataController extends AbstractController
{
    /**
<<<<<<< Updated upstream
=======
     * @var DataRetrieval
     */
    private $dataRetrieval;
    /**
     * @var DataRefactoring
     */
    private $dataRefactoring;

    public function __construct(DataRetrieval $dataRetrieval, DataRefactoring $dataRefactoring)
    {
        $this->dataRetrieval = $dataRetrieval;
        $this->dataRefactoring = $dataRefactoring;
    }

    /**
>>>>>>> Stashed changes
     * @Route("/process/data", name="process_data")
     */
    public function index()
    {
<<<<<<< Updated upstream
        $pup = new Data(new AV);
        $d1=$pup->getData();
        $contents=$pup->refactorData($d1);
=======
        $dataRaw = $this->dataRetrieval->getData();
        $data=$this->dataRefactoring->refactorData($dataRaw);
>>>>>>> Stashed changes


        return $this->render('process_data/index.html.twig', [
            'controller_name' => 'ProcessDataController',
            'data' => $data,
        ]);
    }
}
