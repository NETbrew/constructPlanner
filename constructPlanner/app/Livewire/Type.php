<?php

namespace App\Livewire;

use App\Livewire\Forms\TypeForm;
use Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Type extends Component
{

    use WithPagination;

    public $search;
    public $perPage = 5;
    public $showModal = false;
    public $loading = 'loading...';

    public TypeForm $form;

    // CRUD functions
    public function newJobType() {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function createJobType() {
        $this->form->create();
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "The Job Type <b><i>{$this->form->name}</i></b> has been added",
            'icon' => 'succes',
        ]);
    }

    public function changeJobType(\App\Models\Type $type) {
        $this->resetErrorBag();
        $this->form->fill($type);
        $this->showModal = true;
    }

    public function updateJobType(\App\Models\Type $type) {
        $this->form->update($type);
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "The Job Type <b><i>{$this->form->name}</i></b> has been updated",
            'icon' => 'success',
        ]);
    }

    public function deleteJobType(\App\Models\Type $type) {
        $type->delete();
        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "The Job Type <b><i>{$type->name}</i></b> has been deleted",
            'icon' => 'succes',
        ]);
    }

    #[Layout('components.layout.layout')]
    public function render()
    {
        $currentUser = Auth::user();
        $types = \App\Models\Type::where('user_id', 'like', $currentUser->id)
                        ->orderBy('id')
                        ->searchType($this->search)
                        ->paginate($this->perPage);

        return view('livewire.type', compact('types'));
    }
}
