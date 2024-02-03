<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{

    public $loading = 'loading...';
    #[Layout('components.layout.layout')]
    public function render()
    {
        return view('livewire.dashboard');
    }
}
