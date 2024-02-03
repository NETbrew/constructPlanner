<?php

namespace App\Livewire\Forms;

use App\Models\Type;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TypeForm extends Form
{
    public $id = null;
    #[Validate('required', as: 'name of job type')]
    public $name = null;
    #[Validate('required|min:7', as: 'color of job type')]
    public $color = null;
    public $user_id;
    // read the selected record
    public function read($type)
    {
        $this->id = $type->id;
        $this->name = $type->name;
        $this->color = $type->color;
        $this->user_id = auth()->id();
    }

    // create a new record
    public function create()
    {
        $this->validate();
        Type::create([
            'name' => $this->name,
            'color' => $this->color,
            'user_id' => auth()->id(),
        ]);
    }

    // update the selected record
    public function update(Type $type) {
        $this->validate();
        $type->update([
            'name' => $this->name,
            'color' => $this->color,
            'user_id' => auth()->id(),
        ]);
    }
}
