<?php

namespace Tests\Feature;

use App\Http\Livewire\SearchDropdown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchDropDownTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test  */
    public function component_exist(){
        $this->get('/')->assertSeeLivewire('search-dropdown');
    }
    /** @test  */
    public function if_song_exist(){
        Livewire::test(SearchDropdown::class)
            ->assertDontSee('endo')
            ->set('search','Endo')
            ->assertSee('Endo');
    }
    /** @test  */
    public function if_song_not_exist(){
        Livewire::test(SearchDropdown::class)

            ->set('search','asfdsfdsfdsfsdfdsf')
            ->assertSee('nothing found for');
    }
}
