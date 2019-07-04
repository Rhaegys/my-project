<?php
declare(strict_types=1);
namespace App\DataProcessing;
class FallbackDataRefactoring implements DataRefactoring
{
    /**
     * @var DataRefactoring
     */
    private $refactoring;
    public function __construct(DataRefactoring $refactoring)
    {
        $this->refactoring = $refactoring;
    }
    public function refactorData($data)
    {
        return $refactoring->refactorData($data);        
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