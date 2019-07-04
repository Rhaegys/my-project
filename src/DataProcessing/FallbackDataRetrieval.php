<?php
declare(strict_types=1);
namespace App\DataProcessing;
class FallbackDataRetrieval implements DataRetrieval
{
    /**
     * @var DataRetrieval
     */
    private $retrieval;
    public function __construct(DataRetrieval ...$retrieval)
    {
        $this->retrieval = $retrieval;
    }
    public function getData()
    {
        return $retrieval->getData();        
    }
    /*
    public function refactorData($data)
    {
        foreach ($this->processings as $processing) {
            try {
                return $processing->getData();
            } catch (\Exception $exception) {
                continue;
            }
        }
        throw new \Exception('Procesings unavalable');
    }*/
}