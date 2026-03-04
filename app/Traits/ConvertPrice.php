<?php

namespace App\Traits;

trait ConvertPrice

{
    public function convertToUSD($price)
    {
        return $price / 50;
    }
}
