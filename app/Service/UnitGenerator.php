<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Unit;

class UnitGenerator
{
    /**
     * @var UnitsLoaderInterface
     */
    private $unitsLoader;

    /**
     * UnitGenerator constructor.
     *
     * @param  UnitsLoaderInterface  $unitsLoader
     */
    public function __construct(UnitsLoaderInterface $unitsLoader)
    {
        $this->unitsLoader = $unitsLoader;
    }

    /**
     * @param int $numberOfUnits
     * @return Unit[]
     */
    public function generateUnits(int $numberOfUnits): array
    {
        $general = $this->unitsLoader->getGeneral();
        $units = $this->unitsLoader->getUnits();

        $generatedUnits = [];

        // First unit is general unit
        $type = array_shift($general);
        $generatedUnits[] = new Unit($type, $general);

        for ($i = 0; $i < $numberOfUnits; $i++) {
            $randomKey = array_rand($units);
            $unit = $units[$randomKey];
            $type = array_shift($unit);
            $generatedUnits[] = new Unit($type, $unit);
        }

        return $generatedUnits;
    }
}
