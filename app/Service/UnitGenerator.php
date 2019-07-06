<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Unit;

class UnitGenerator
{
    /**
     * @var UnitsLoader
     */
    private $unitsLoader;

    /**
     * UnitGenerator constructor.
     */
    public function __construct(UnitsLoader $unitsLoader)
    {
        $this->unitsLoader = $unitsLoader;
    }

    /**
     * @param $numberOfUnits
     * @return Unit[]
     */
    public function generateUnits($numberOfUnits): array
    {
        $units = $this->unitsLoader->getUnits();

        $generatedUnits = [];
        for ($i = 0; $i < $numberOfUnits; $i++) {
            $randomKey = array_rand($units);
            $unit = $units[$randomKey];
            $type = array_shift($unit);
            $generatedUnits[] = new Unit($type, $unit);
        }

        return $generatedUnits;
    }
}
