<?php

declare(strict_types=1);

namespace spec\App\Service;

use App\Model\Army;
use App\Model\BattleResult;
use App\Model\Unit;
use App\Service\BattleManager;
use PhpSpec\ObjectBehavior;

class BattleManagerSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(BattleManager::class);
    }

    public function let(Army $army1, Army $army2): void
    {
        $this->beConstructedWith($army1, $army2);
    }

    public function it_should_win_army1_if_unit1_create_enough_damage_to_kill_unit2(Army $army1, Army $army2, Unit $unit1, Unit $unit2)
    {
        $this->setTestingMode();

        $army1->canFight()->willReturn(true);
        $army2->canFight()->willReturn(true, false);
        $army1->getUnitForFight()->willReturn($unit1);
        $army2->getUnitForFight()->willReturn($unit2);

        $unit1->isAttackSuccessful()->willReturn(true);
        $unit1->getStrength()->shouldBeCalled();
        $unit2->getArmour()->shouldBeCalled();
        $unit2->reduceHealth(0)->shouldBeCalled();

        $unit2->isFall()->willReturn(true);
        $army1->isUnitExist($unit2)->willReturn(false);
        $army2->isUnitExist($unit2)->willReturn(true);
        $army2->removeUnit($unit2)->shouldBeCalled();

        $battleResult = $this->start();

        $battleResult->shouldBeAnInstanceOf(BattleResult::class);
        $battleResult->getWinningArmy()->shouldReturn($army1);
        $battleResult->getTurn()->shouldReturn(1);
    }
}
