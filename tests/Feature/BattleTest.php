<?php

namespace Tests\Feature;

use Tests\TestCase;

class BattleTest extends TestCase
{
    /** @test */
    public function show_page_with_battle_result()
    {
        $this->get('/?army1=1&army2=2')
            ->assertStatus(200)
            ->assertSee('Battle result');
    }

    /** @test */
    public function it_requires_number_of_units_for_army1()
    {
        $this->get('/?army2=2')
            ->assertSee('The army1 parameter is required.')
            ->assertStatus(200);
    }

    /** @test */
    public function it_requires_number_of_units_for_army2()
    {
        $this->get('/?army1=2')
            ->assertSee('The army2 parameter is required.')
            ->assertStatus(200);
    }

    /** @test */
    public function it_requires_integer_for_number_of_units_for_army1()
    {
        $this->get('/?army1=www&army2=2')
            ->assertSee('The army1 must be an integer.')
            ->assertStatus(200);
    }

    /** @test */
    public function it_requires_integer_for_number_of_units_for_army2()
    {
        $this->get('/?army1=1&army2=www')
            ->assertSee('The army2 must be an integer.')
            ->assertStatus(200);
    }

    /** @test */
    public function it_requires__number_of_units_greater_than_zero_for_army1()
    {
        $this->get('/?army1=0&army2=2')
            ->assertSee('The army1 must be at least 1.')
            ->assertStatus(200);
    }

    /** @test */
    public function it_requires__number_of_units_greater_than_zero_for_army2()
    {
        $this->get('/?army1=1&army2=-1')
            ->assertSee('The army2 must be at least 1.')
            ->assertStatus(200);
    }
}
