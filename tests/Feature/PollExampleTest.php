<?php

namespace Tests\Feature;

use App\Http\Livewire\PollExample;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PollExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertSeeLivewire('poll-example');
    }
    /**
     * @test
     */
    public function test_poll(){
       $ora= Order::create(['price'=>20]);
       $orb= Order::create(['price'=>20]);
       $orc= Order::create(['price'=>20]);
       Livewire::test(PollExample::class)
           ->call('getRevenue')
           ->assertSee('60');
    }
}
