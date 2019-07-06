<?php

declare(strict_types=1);

namespace App\Model;

class Unit
{
    private const REGENERATION_POINTS = 2;

    private const POINTS_FOR_LEVEL_UP = 2;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $strength;

    /**
     * @var int
     */
    private $armour;

    /**
     * @var int
     */
    private $accuracy;

    /**
     * @var int
     */
    private $maxHealth;

    /**
     * @var int
     */
    private $health;

    /**
     * @var int
     */
    private $morale;

    /**
     * @var int
     */
    private $experience = 0;

    /**
     * Unit constructor.
     *
     * @param  string  $type
     * @param  array  $stats
     */
    public function __construct(string $type, array $stats)
    {
        $this->type = $type;
        $this->strength = $stats['strength'];
        $this->armour = $stats['armour'];
        $this->accuracy = $stats['accuracy'];
        $this->maxHealth = $stats['maxHealth'];
        $this->health = $stats['maxHealth'];
        $this->morale = $stats['morale'];
    }

    /**
     * Return type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Return the name of general unit.
     *
     * @return string
     */
    public function getGeneralType(): string
    {
        return "General";
    }

    /**
     * Return value strength
     *
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * Return value for armour
     *
     * @return int
     */
    public function getArmour(): int
    {
        return $this->armour;
    }

    /**
     * Return value for accuracy
     *
     * @return int
     */
    public function getAccuracy(): int
    {
        return $this->accuracy;
    }

    /**
     * Return value for health
     *
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Return value for maximum health
     *
     * @return int
     */
    public function getMaxHealth(): int
    {
        return $this->maxHealth;
    }

    /**
     * Return value for morale
     *
     * @return int
     */
    public function getMorale(): int
    {
        return $this->morale;
    }

    /**
     * Checking if unit starting to run from battle.
     *
     * @return bool
     */
    public function isStartingToRun(): bool
    {
        return $this->morale <= rand(1, 100);
    }

    /**
     * Checking if attack successful.
     *
     * @return bool
     */
    public function isAttackSuccessful(): bool
    {
        return $this->accuracy <= rand(1, 100);
    }

    /**
     * Set health to given value.
     *
     * @param  int  $health
     */
    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * Reduce health to zero.
     */
    public function setHealthToZero(): void
    {
        $this->health = 0;
    }

    /**
     * Reduce health after attacker cause damage.
     *
     * @param int $damage
     */
    public function reduceHealth(int $damage): void
    {
        $this->health -= $damage;
    }

    /**
     * Check if unit have health above zero.
     *
     * @return bool
     */
    public function isFall(): bool
    {
        return $this->health <= 0;
    }

    public function regenerate(): void
    {
        $this->health += self::REGENERATION_POINTS;

        if ($this->health > $this->maxHealth) {
            $this->health = $this->maxHealth;
        }
    }

    /**
     * Increasing experience and attributes of unit.
     */
    public function increaseExperience(): void
    {
        $this->experience++;
        $this->strength += self::POINTS_FOR_LEVEL_UP;
        $this->armour += self::POINTS_FOR_LEVEL_UP;
        $this->accuracy += self::POINTS_FOR_LEVEL_UP;
        $this->maxHealth += self::POINTS_FOR_LEVEL_UP;
        $this->morale += self::POINTS_FOR_LEVEL_UP;
    }
}
