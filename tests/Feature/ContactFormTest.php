<?php

namespace Tests\Feature;

use App\Http\Livewire\ContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;

class ContactFormTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_example()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }
    /** @test */
    public function main_page_contains_contact_form_livewire_component()
    {
        $this->get('/')->assertSeeLivewire('contact-form');
    }

    /** @test */
    public function contact_form_submit()
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'endo')
            ->set('email', 'endo@ends.com')
            ->set('phone', '54545454')
            ->set('message', 'asdasdasd')
            ->call('submitForm')
            ->assertSee('We received your message successfully and will get back to you shortly!');
    }
    /** @test  */
    public function form_have_validation_errors(){
        Livewire::test(ContactForm::class)

            ->set('email', 'endocom')
            ->set('phone', '54545454')
            ->set('message', 'asdasdasd')
            ->call('submitForm')
            ->assertHasErrors(['name'=>'required','email'=>'email']);
    }
}
