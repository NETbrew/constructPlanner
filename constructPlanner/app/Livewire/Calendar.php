<?php

namespace App\Livewire;

use App\Livewire\Forms\WorkForm;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public $currentDate;

    public $showModal = false;
    public $info = false;
    public $copy = false;
    public WorkForm $form;
    public $loading = 'loading...';

    public function mount()
    {
        $this->currentDate = Carbon::now();
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

    public function copyWork(Work $work) {
        $this->resetErrorBag();
        $this->form->fill($work);
        $this->copy = true;
        $this->info = false;
    }
    public function copyWorkToDay(Work $work, Carbon $destinationDay) {
        // Duplicate the work attributes
        $newWorkAttributes = $work->toArray();

        // Set the date to the destination day
        $newWorkAttributes['date'] = $destinationDay->toDateString();

        // Create a new Work instance with the duplicated attributes
        $this->form->create($newWorkAttributes);

        $this->copy = false;
        $this->showModal = false;

        $this->dispatch('swal:toast', [
            'background' => 'info',
            'html' => "<b><i>{$work->title}</i></b> has been copied to {$destinationDay->format('F j, Y')}",
            'icon' => 'success',
        ]);
    }

    public function getPreviousMonth()
    {
        $this->currentDate->subMonth();
    }

    public function getNextMonth()
    {
        $this->currentDate->addMonth();
    }

    public function render()
    {
        $daysInMonth = $this->currentDate->daysInMonth;
        $firstDayOfMonth = $this->currentDate->firstOfMonth();
        $startDayOfWeek = $firstDayOfMonth->copy()->dayOfWeek; // Adjust this line

        $days = collect(range(1, $daysInMonth + $startDayOfWeek))->map(function ($day) use ($firstDayOfMonth, $startDayOfWeek) {
            return $firstDayOfMonth->copy()->subDays($startDayOfWeek)->addDays($day);
        });

        $user = Auth::user();
        $workJobs = Work::where('user_id', $user->id)
            ->with('type') // Eager load the type relationship
            ->orderBy('date', 'asc')
            ->get();

        $types = \App\Models\Type::orderBy('id')->get();

        return view('livewire.calendar', compact('days', 'types', 'workJobs'));
    }
}
