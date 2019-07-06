<?php

declare(strict_types=1);

namespace App\Service;

class UnitsLoader
{
    public function getUnits()
    {
        return config('app.units');
    }
}
