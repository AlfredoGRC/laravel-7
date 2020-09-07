<?php

namespace Tests\Feature;


use App\Gamer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function view_games_index()
    {
         $gamer = factory(Gamer::class)->state('published')->times(4)->create()->first();

         $this->get('/juegos')
              ->assertSuccessful()
              ->assertViewIs('gamers.index')
              ->assertViewHas('gamers', fn ($gamers) => $gamers->count() === 4)
              ->assertSee($gamer->name);
    }
}
