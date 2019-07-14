<?php

namespace App\DataProcessing;

/**
 * Interface for Data Refactoring, is implemented by RefactoringProcess, RefactoredAlphaData and RefactoredWTGData
 */
interface DataRefactoring
{
    public function refactorData($data, $userApiOrigin);
}
