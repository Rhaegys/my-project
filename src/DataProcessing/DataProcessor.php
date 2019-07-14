<?php

namespace App\DataProcessing;

use App\Repository\InstrumentRepository;

class DataProcessor
{
    public function getAssetsWorth(InstrumentRepository $instrumentRepository, $prices, $userId)
    {
        foreach ($prices as $symbol => &$data) {
            $instrument = $instrumentRepository->findByOwnerAndSymbol($userId, $symbol);            
            $quantity = $instrument->getQuantity();
            foreach ($data['Price'] as &$value) {
                $value = $value * $quantity;
            }
            unset($value);
        }
        unset($data);
        return $prices;
    }
}
