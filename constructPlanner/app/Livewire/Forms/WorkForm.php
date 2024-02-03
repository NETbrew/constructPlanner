<?php

namespace App\Livewire\Forms;

use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class WorkForm extends Form
{
    public $id = null;
    #[Validate('required|min:3', as: 'title of work')]
    public $title = null;
    #[Validate('min:3', as: 'location of work')]
    public $location = null;
    #[Validate('min:9', as: 'telephone number of client')]
    public $telephone = null;
    #[Validate('min:6', as: 'email address of client')]
    public $email = null;
    #[Validate('required|min:1', as: 'squaremeter of work')]
    public $squaremeters = null;
    #[Validate('required', as: 'date of work')]
    public $date = null;
    public $note;
    public $user_id;
    #[Validate('required|exists:types,id', as: 'type')]
    public $type_id = null;


    // read the selected record
    public function read($work)
    {
        $this->id = $work->id;
        $this->title = $work->title;
        $this->location = $work->location;
        $this->telephone = $work->telephone;
        $this->email = $work->email;
        $this->squaremeters = $work->squaremeters;
        $this->date = $work->date;
        $this->note = $work->note;
        $this->user_id = auth()->id();
        $this->type_id = $work->type;
    }

    // create a new record
    public function create()
    {
        $this->validate();
        Work::create([
            'title' => $this->title,
            'location' => $this->location,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'squaremeters' => $this->squaremeters,
            'date' => $this->date,
            'note' => $this->note,
            'user_id' => auth()->id(),
            'type_id' => $this->type_id,
        ]);
    }

    // update the selected record
    public function update(Work $type) {
        $this->validate();
        $type->update([
            'title' => $this->title,
            'location' => $this->location,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'squaremeters' => $this->squaremeters,
            'date' => $this->date,
            'note' => $this->note,
            'user_id' => auth()->id(),
            'type_id' => $this->type_id,
        ]);
    }
}
