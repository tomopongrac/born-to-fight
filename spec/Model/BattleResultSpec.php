<?php

declare(strict_types=1);

namespace spec\App\Model;

use App\Model\Army;
use App\Model\BattleResult;
use PhpSpec\ObjectBehavior;

class BattleResultSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(BattleResult::class);
    }

    public function let(Army $army): void
    {
        $turn = 1;
        $this->beConstructedWith($army, $turn);
    }

    public function it_has_winning_army(Army $army): void
    {
        $this->getWinningArmy()->shouldReturn($army);
    }

    public function it_has_turn()
    {
        $this->getTurn()->shouldReturn(1);
    }
}
