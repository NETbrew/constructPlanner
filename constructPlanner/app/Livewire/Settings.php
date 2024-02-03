<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Settings extends Component
{
    #[Layout('components.layout.layout')]
    public function render()
    {
        return view('livewire.settings');
    }
}
