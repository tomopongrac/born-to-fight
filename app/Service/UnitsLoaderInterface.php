<?php

declare(strict_types=1);

namespace App\Service;

interface UnitsLoaderInterface
{
    /**
     * Load general unit.
     *
     * @return array
     */
    public function getGeneral(): array;

    /**
     * Load regular units.
     *
     * @return array
     */
    public function getUnits(): array;
}
