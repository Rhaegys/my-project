<?php

namespace App\DataProcessing;

/**
 * Interface for Data Retrieval, is implemented by DataSourceOrigin, DataFromAlpha and DataFromWTG
 */
interface DataRetrieval
{
    public function getData($instruments, $userApiOrigin);
}
 