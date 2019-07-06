<?php

declare(strict_types=1);

namespace spec\App\Service;

use App\Model\Unit;
use App\Service\UnitGenerator;
use App\Service\UnitsLoader;
use PhpSpec\ObjectBehavior;

class UnitGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(UnitGenerator::class);
    }

    public function let(UnitsLoader $unitLoader): void
    {
        $this->beConstructedWith($unitLoader);
    }

    public function it_can_generate_random_number_of_units(UnitsLoader $unitLoader)
    {
        $unitLoader->getUnits()->willReturn([
            [
                'type' => 'Archer',
                'strength' => 7,
                'armour' => 1,
                'accuracy' => 50,
                'maxHealth' => 30,
            ],
        ]);

        $numberOfUnits = 2;
        $units = $this->generateUnits($numberOfUnits);

        $units[0]->shouldBeAnInstanceOf(Unit::class);
        $units[1]->shouldBeAnInstanceOf(Unit::class);
    }
}
