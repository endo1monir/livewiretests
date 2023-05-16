<?php

namespace Tests\Feature;

use App\Http\Livewire\DataTables;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DatatableTest extends TestCase
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

        $response->assertSeeLivewire('data-tables');
    }

    /** @test */
    public function check_active_checkbox_work_correctly()
    {
        $userA = User::create([
            'name' => 'user',
            'email' => 'enads@emsd.com',
            'password' => bcrypt('password'),
            'active' => true
        ]);
        $userB = User::create([
            'name' => 'userB',
            'email' => 'enadss@emsd.com',
            'password' => bcrypt('password'),
            'active' => false
        ]);
        Livewire::test(DataTables::class)
            ->assertSee($userA->name)
            ->assertSee($userB->name)
            ->set('active',false)
            ->assertDontSee($userB->name)
;

    }
}
