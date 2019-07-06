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
}
