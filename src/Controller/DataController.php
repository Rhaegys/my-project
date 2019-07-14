<?php

namespace App\Controller;

use App\DataProcessing\DataRetrieval;
use App\DataProcessing\DataRefactoring;
use App\DataProcessing\DataProcessor;
use App\DataProcessing\RefactoredAlphaData;
use App\DataProcessing\RefactoredWTGData;
use App\DataProcessing\WorthCalculator;
use App\DataProcessing\YearlyYieldCalculator;
use App\Repository\InstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\NativeHttpClient;

class DataController extends AbstractController
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
        /**
         * Interfaces for working with different Financial APIs
         *  */
        $this->dataRetrieval = $dataRetrieval;
        $this->dataRefactoring = $dataRefactoring;
    }
    /**
     * @Route("/data", name="data")
     */
    public function index(InstrumentRepository $instrumentRepository, DataProcessor $dataProcessor, WorthCalculator $worthCalculator, YearlyYieldCalculator $yearlyYieldCalculator)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); 
        /**
         * This section gets data for curent user, could be done in separate module
         *  */              
        $userId = $this->getUser()->getId();        
        $instruments = $instrumentRepository->findByOwner($userId);         
        $rawPrices = $this->dataRetrieval->getData($instruments); 
        /**
         * This section refactors data for processing
         *  */                                   
        $prices = $this->dataRefactoring->refactorData($rawPrices);                
        $dataProcessor = new DataProcessor(); 
        /**
         * This section processes data for view
         *  */   
        $assetsWorth = $dataProcessor->getAssetsWorth($instrumentRepository, $prices, $userId);        
        $worthCalculator = new WorthCalculator();
        $netWorth = $worthCalculator->calculateNetWorth($assetsWorth);
        $yearlyYieldCalculator = new YearlyYieldCalculator();
        $yearlyYield = $yearlyYieldCalculator->calculateYearlyYield($netWorth);   

        return $this->render('data/index.html.twig', [
            'controller_name' => 'DataController',
            'data' => $netWorth,
            'yield' => $yearlyYield,
            'assets' => $instruments
        ]);
    }    
}
