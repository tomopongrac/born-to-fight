<?php

declare(strict_types=1);

namespace spec\App\Model;

use App\Model\Unit;
use PhpSpec\ObjectBehavior;

class UnitSpec extends ObjectBehavior
{
    private $type = 'Some Unit';

    private $stats = [
        'strength' => 10,
        'armour' => 2,
        'accuracy' => 50,
        'maxHealth' => 100,
    ];

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Unit::class);
    }

    public function let(): void
    {
        $this->beConstructedWith($this->type, $this->stats);
    }

    public function it_has_strength(): void
    {
        $this->getStrength()->shouldReturn(10);
    }

    public function it_has_armour(): void
    {
        $this->getArmour()->shouldReturn(2);
    }

    public function it_has_accuracy(): void
    {
        $this->getAccuracy()->shouldReturn(50);
    }

    public function it_has_health(): void
    {
        $this->getHealth()->shouldReturn(100);
    }

    public function it_has_max_health(): void
    {
        $this->getMaxHealth()->shouldReturn(100);
    }
}
