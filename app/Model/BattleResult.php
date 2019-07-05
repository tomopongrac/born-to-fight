<?php

declare(strict_types=1);

namespace App\Model;

class BattleResult
{
    /**
     * @var Army
     */
    private $winningArmy;

    /**
     * @var int
     */
    private $turn;

    /**
     * BattleResult constructor.
     *
     * @param  Army  $winningArmy
     * @param  int  $turn
     */
    public function __construct(Army $winningArmy, int $turn)
    {
        $this->winningArmy = $winningArmy;
        $this->turn = $turn;
    }

    /**
     * Return winning army.
     *
     * @return Army
     */
    public function getWinningArmy(): Army
    {
        return $this->winningArmy;
    }

    /**
     * Return how much turns was battle take.
     *
     * @return int
     */
    public function getTurn(): int
    {
        return $this->turn;
    }
}
