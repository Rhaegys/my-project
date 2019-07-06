<?php

namespace App\Controller;

use App\DataProcessing\DataRetrieval;
use App\DataProcessing\DataRefactoring;
use App\DataProcessing\RefactoredAlphaData;
use App\DataProcessing\RefactoredWTGData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\NativeHttpClient;
#use App\DataProcessing\DataFromAlpha;
#use App\DataProcessing\DataFromWTG;

class ProcessDataController extends AbstractController
{
    /**
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
     * @Route("/process/data", name="process_data")
     */
    public function index()
    {
        $dataRaw = $this->dataRetrieval->getData();
        $data=$this->dataRefactoring->refactorData($dataRaw);

        return $this->render('process_data/index.html.twig', [
            'controller_name' => 'ProcessDataController',
            'data'=> $data
        ]);
    }
}
