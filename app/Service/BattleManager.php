<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Army;
use App\Model\BattleResult;
use App\Model\Unit;

class BattleManager
{
    /**
     * @var bool
     */
    private $testingMode = false;

    /**
     * @var Army
     */
    private $army1;

    /**
     * @var Army
     */
    private $army2;

    /**
     * @var int
     */
    private $turn;

    /**
     * BattleManager constructor.
     *
     * @param  Army  $army1
     * @param  Army  $army2
     */
    public function __construct(Army $army1, Army $army2)
    {
        $this->army1 = $army1;
        $this->army2 = $army2;
    }

    /**
     * Start the battle between armies.
     *
     * @return BattleResult
     */
    public function start(): BattleResult
    {
        while ($this->army1->canFight() && $this->army2->canFight()) {
            $this->regenerateArmies();

            $this->turn++;

            /** @var Unit $attacker */
            /** @var Unit $defender */
            list($attacker, $defender) = $this->setStrikingOrder();

            $this->attackerAttack($attacker, $defender);

            if ($defender->isFall()) {
                $attacker->increaseExperience();
                $this->deleteUnitFromArmy($defender);
                continue;
            }

            $this->defenderAttack($attacker, $defender);

            if ($attacker->isFall()) {
                $defender->increaseExperience();
                $this->deleteUnitFromArmy($attacker);
                continue;
            }
        }

        return new BattleResult($this->getWinningArmy(), $this->turn);
    }

    /**
     * Get units for attacker and defender.
     *
     * @return array
     */
    public function setStrikingOrder(): array
    {
        $units = [$this->army1->getUnitForFight(), $this->army2->getUnitForFight()];

        if ($this->testingMode === false) {
            shuffle($units);
        }

        return $units;
    }

    /**
     * Attack from attacker
     *
     * @param  Unit  $attacker
     * @param  Unit  $defender
     */
    public function attackerAttack(Unit $attacker, Unit $defender): void
    {
        if ($defender->isStartingToRun()) {
            $defender->setHealthToZero();
            return;
        }

        if ($attacker->isAttackSuccessful()) {
            $damage = $this->calculateDamage($attacker, $defender);
            $defender->reduceHealth($damage);
        }
    }

    /**
     * Attack from defender.
     *
     * @param  Unit  $defender
     * @param  Unit  $attacker
     */
    private function defenderAttack(Unit $defender, Unit $attacker): void
    {
        $this->attackerAttack($defender, $attacker);
    }

    /**
     * Calculate how much damage will attacker perform.
     *
     * @param  Unit  $attacker
     * @param  Unit  $deffender
     * @return int
     */
    private function calculateDamage(Unit $attacker, Unit $deffender): int
    {
        return $attacker->getStrength() - $deffender->getArmour();
    }

    /**
     * Delete falling unit from army which she belong.
     *
     * @param  Unit  $unit
     */
    private function deleteUnitFromArmy(Unit $unit): void
    {
        if ($this->army1->isUnitExist($unit)) {
            $this->army1->removeUnit($unit);
        }

        if ($this->army2->isUnitExist($unit)) {
            $this->army2->removeUnit($unit);
        }
    }

    /**
     * Return army which win.
     *
     * @return Army
     */
    private function getWinningArmy(): Army
    {
        if ($this->army1->canFight()) {
            return $this->army1;
        }

        return $this->army2;
    }

    /**
     * Setting testing mode so i can perform test.
     * Problem was because i changing attacker and deffender.
     */
    public function setTestingMode(): void
    {
        $this->testingMode = true;
    }

    /**
     * Regenerate all units in both armies.
     */
    private function regenerateArmies(): void
    {
        if ($this->turn != 0) {
            $this->army1->regenerateUnits();
            $this->army2->regenerateUnits();
        }
    }
}
