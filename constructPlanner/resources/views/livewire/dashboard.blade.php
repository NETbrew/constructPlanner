<div x-data="{ showMonth: false }">
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
         wire:loading>
        <x-planner.preloader class="bg-lime-700/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-planner.preloader>
    </div>
    <div class="ml-44">
        <label class="uppercase pr-3" for="month">month</label>
        <input x-model="showMonth"
               type="checkbox" name="month" id="month">
    </div>
    <div x-show="!showMonth">
        @livewire('agenda')
    </div>
    <div x-show="showMonth">
        @livewire('calendar')
    </div>
</div>
