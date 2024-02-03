<?php

namespace App\Livewire;

use App\Livewire\Forms\WorkForm;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Agenda extends Component
{
    public $currentDate;
    public $showModal = false;
    public $info = false;
    public WorkForm $form;
    public $loading = 'loading...';

    public function mount()
    {
        $this->currentDate = Carbon::now()->startOfWeek();
    }

    // CRUD functions for work
    public function readWork(Work $work) {
        $this->form->read($work);
        $this->resetErrorBag();
        $this->info = true;
        $this->showModal = true;
    }

    public function addWork() {
        $this->form->reset();
        $this->resetErrorBag();
        $this->info = false;
        $this->showModal = true;
    }

    public function createWork() {
        $this->form->create();
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "<b><i>{$this->form->title}</i></b> has been added to the agenda",
            'icon' => 'succes',
        ]);
    }

    public function editWork(Work $work) {
        $this->resetErrorBag();
        $this->form->fill($work);
        $this->info = false;
    }

    public function updateWork(Work $work) {
        $this->form->update($work);
        $this->info = true;
        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "<b><i>{$this->form->title}</i></b> has been updated",
            'icon' => 'success',
        ]);
    }

    public function deleteWork(Work $work) {
        $work->delete();
        $this->showModal = false;
        $this->info = false;
        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "<b><i>{$work->title}</i></b> has been deleted",
            'icon' => 'succes',
        ]);
    }

    public function render()
    {
        $weekdays = $this->getWeekdays();
        $user = Auth::user();
        $workJobs = Work::where('user_id', $user->id)
            ->with('type') // Eager load the type relationship
            ->orderBy('date', 'asc')
            ->get();

        $types = \App\Models\Type::where('user_id', $user->id)->orderBy('id')->get();

        return view('livewire.agenda', compact('weekdays', 'workJobs', 'types'));
    }

    public function getNextWeek()
    {
        return $this->currentDate->subDays(1)->addWeek();
    }

    public function getPreviousWeek()
    {
        return $this->currentDate->subDays(1)->subWeek();
    }

    protected function getWeekdays()
    {
        $startOfWeek = $this->currentDate->subDays(1)->startOfWeek();
        $endOfWeek = $this->currentDate->endOfWeek();

        return Collection::times(5, function ($dayOffset) use ($startOfWeek) {
            return $startOfWeek->copy()->addDays($dayOffset);
        });
    }
}
