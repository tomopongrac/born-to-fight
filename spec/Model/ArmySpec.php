<?php

declare(strict_types=1);

namespace spec\App\Model;

use App\Model\Army;
use App\Model\Unit;
use PhpSpec\ObjectBehavior;

class ArmySpec extends ObjectBehavior
{
    private $armyName = 'Army';

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Army::class);
    }

    public function let(): void
    {
        $this->beConstructedWith($this->armyName);
    }

    public function it_has_name(): void
    {
        $this->getName()->shouldReturn($this->armyName);
    }

    public function it_should_not_have_units_by_default(): void
    {
        $this->getUnitsCount()->shouldReturn(0);
    }

    public function it_should_be_able_to_add_units(Unit $unit1, Unit $unit2)
    {
        $this->addUnit($unit1);
        $this->addUnit($unit2);

        $this->getUnitsCount()->shouldReturn(2);
    }

    public function it_should_be_able_to_remove_units(Unit $unit1, Unit $unit2): void
    {
        $this->addUnit($unit1);
        $this->addUnit($unit2);

        $this->removeUnit($unit1);

        $this->getUnitsCount()->shouldReturn(1);
    }

    public function it_should_know_if_army_can_fight(Unit $unit): void
    {
        $this->addUnit($unit);

        $this->canFight()->shouldReturn(true);
    }

    public function it_should_know_if_army_is_defeated(): void
    {
        $this->getUnitsCount()->shouldReturn(0);

        $this->isDefeated()->shouldReturn(true);
    }

    public function it_should_return_unit_for_fight(Unit $unit): void
    {
        $this->addUnit($unit);

        $this->getUnitForFight()->shouldReturn($unit);
    }
}
