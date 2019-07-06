<?php

declare(strict_types=1);

namespace App\Service;

class ConfigUnitsLoader implements UnitsLoaderInterface
{
    /**
     * Load general unit.
     *
     * @return array
     */
    public function getUnits(): array
    {
        return config('app.units');
    }

    /**
     * Load regular units.
     *
     * @return array
     */
    public function getGeneral(): array
    {
        return config('app.general');
    }
}
