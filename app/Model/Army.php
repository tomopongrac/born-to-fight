<?php

declare(strict_types=1);

namespace App\Model;

use App\User;

class Army
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $units = [];

    /**
     * Army constructor.
     *
     * @param  string  $name
     * @param  array  $units
     */
    public function __construct(string $name, array $units = [])
    {
        $this->name = $name;
        foreach ($units as $unit) {
            $this->addUnit($unit);
        }
    }

    /**
     * Return name of army.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Return number of units in army.
     *
     * @return int
     */
    public function getUnitsCount(): int
    {
        return count($this->units);
    }

    /**
     * Adding unit to army.
     *
     * @param  Unit  $unit
     */
    public function addUnit(Unit $unit): void
    {
        $id = spl_object_id($unit);
        $this->units[$id] = $unit;
    }

    /**
     * Removing unit from army.
     *
     * @param  Unit  $unit
     */
    public function removeUnit(Unit $unit): void
    {
        if ($this->isUnitExist($unit)) {
            $id = spl_object_id($unit);
            unset($this->units[$id]);
        }
    }

    /**
     * Checking if unit exist in army.
     *
     * @param  Unit  $unit
     * @return bool
     */
    public function isUnitExist(Unit $unit): bool
    {
        $id = spl_object_id($unit);
        return isset($this->units[$id]);
    }

    /**
     * Check if army have units so that she can fight.
     *
     * @return bool
     */
    public function canFight(): bool
    {
        return $this->getUnitsCount() > 0;
    }

    /**
     * Check if army is defeated.
     *
     * @return bool
     */
    public function isDefeated(): bool
    {
        return !$this->canFight();
    }

    /**
     * Return random units which will fight in battle.
     *
     * @return Unit
     */
    public function getUnitForFight(): Unit
    {
        return $this->units[array_rand($this->units)];
    }
}
