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
        $unit2->isStartingToRun()->willReturn(false);
        $unit1->getStrength()->shouldBeCalled();
        $unit2->getArmour()->shouldBeCalled();
        $unit2->reduceHealth(0)->shouldBeCalled();

        $unit2->isFall()->willReturn(true);
        $unit1->increaseExperience()->shouldBeCalled();
        $army1->isUnitExist($unit2)->willReturn(false);
        $army2->isUnitExist($unit2)->willReturn(true);
        $army2->removeUnit($unit2)->shouldBeCalled();

        $battleResult = $this->start();

        $battleResult->shouldBeAnInstanceOf(BattleResult::class);
        $battleResult->getWinningArmy()->shouldReturn($army1);
        $battleResult->getTurn()->shouldReturn(1);
    }

    public function it_looks_if_unit_starts_to_run_from_attacker_if_so_than_that_unit_is_automatically_slain(Army $army1, Army $army2, Unit $unit1, Unit $unit2)
    {
        $unit2->isStartingToRun()->willReturn(true);
        $unit2->setHealthToZero()->shouldBeCalled();
        $unit1->isAttackSuccessful()->shouldNotBeCalled();

        $this->attackerAttack($unit1, $unit2);
    }

    public function it_should_regenerate_armies_after_each_turn(Army $army1, Army $army2, Unit $unit1, Unit $unit2)
    {
        $army1->canFight()->willReturn(true, true, false);
        $army2->canFight()->willReturn(true, true);
        $army1->getUnitForFight()->willReturn($unit1);
        $army2->getUnitForFight()->willReturn($unit2);
        $unit1->isStartingToRun()->willReturn(false);
        $unit2->isStartingToRun()->willReturn(false);
        $unit1->isAttackSuccessful()->willReturn(false);
        $unit2->isAttackSuccessful()->willReturn(false);
        $unit1->isFall()->willReturn(false);
        $unit2->isFall()->willReturn(false);

        $army1->regenerateUnits()->shouldBeCalled();
        $army2->regenerateUnits()->shouldBeCalled();

        $this->start();
    }
}
