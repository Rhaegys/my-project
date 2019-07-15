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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security;

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
        $userApi = $this->getUser()->getApiSource();        
        $instruments = $instrumentRepository->findByOwner($userId);         
        if (!$instruments) {  
            return $this->render('data/no_assets.html.twig', [                
            ]);          
        } 
        $userApiOrigin = $this->getUser()->getApiSource();       
        $rawPrices = $this->dataRetrieval->getData($instruments, $userApiOrigin); 
        /**
         * This section refactors data for processing
         *  */
        $prices = $this->dataRefactoring->refactorData($rawPrices, $userApiOrigin);                
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
            'assets' => $instruments,
            'api' => $userApi,
        ]);
    }
    /**
     * This function sets up route to change Financial API
     * @Route("/data/setapi/{api}", name="set_api", methods={"GET"})
     */
    public function setApi(Request $request): Response
    {
        $api = $request->query->get('api');
        $this->getUser()->setApiSource($api);        
        $this->getDoctrine()->getManager()->flush(); 
        return $this->redirectToRoute('data');
    }   
}