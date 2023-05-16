<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $successMessage;
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'message' => 'required|min:5'
    ];

    public function updated($propertyName)

    {

        $this->validateOnly($propertyName);

    }
    public function submitForm()
    {
        $contact = $this->validate();
        sleep(1);
        $this->resetForm();
//session()->flash('success_message','We received your message successfully and will get back to you shortly!');
        $this->successMessage = 'We received your message successfully and will get back to you shortly!';
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
