<?php

namespace App\Services;

class ConvertPriceService
{
    public function convertToUSD($price)
    {
        return $price / 50;
    }
}
