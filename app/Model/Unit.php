<?php

declare(strict_types=1);

namespace App\Model;

class Unit
{
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
     * Checking if attack successful.
     *
     * @return bool
     */
    public function isAttackSuccessful(): bool
    {
        return $this->accuracy <= rand(1, 100);
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
}
