<div class="ml-44">
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
         wire:loading>
        <x-planner.preloader class="bg-lime-700/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-planner.preloader>
    </div>
    <h1 class="text-3xl uppercase font-bold text-gray-700 mb-3">Job Types</h1>
    {{-- Search function & add button --}}
    <x-planner.section class="mb-4 flex gap-2">
        <div class="flex-1">
            <x-input wire:model.live.debounce.500ms="search"
                id="search" type="text" placeholder="Find job type"
                     class="w-full shadow-md placeholder-gray-300"/>
        </div>
        <x-button wire:click="newJobType">
            <i class="fa-solid fa-plus pr-2"></i>
            new type
        </x-button>
    </x-planner.section>

    {{-- Table with records --}}
    <x-planner.section>
        <div class="my-4">{{ $types->links() }}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-1/4">
                <col class="w-1/6">
                <col class="w-40">
                <col class="w-12">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>name</th>
                <th>hex-color</th>
                <th></th>
                <th>
                    <x-planner.select id="perPage"
                                       class="block mt-1 w-full"
                                        wire:model.live="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </x-planner.select>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($types as $type)
                <tr wire:key="{{ $type->id }}"
                    class="border-t border-gray-300">
                    <td>{{ $type->name }}</td>
                    <td style="background-color: {{ $type->color }}"  class="font-bold">{{ $type->color }}</td>
                    <td></td>
                    <td>
                        <div class="border border-gray-300 rounded-md overflow-hidden m-2 grid grid-cols-2 h-10">
                            <button wire:click="changeJobType({{ $type->id }})"
                                class="text-gray-400 hover:text-sky-100 hover:bg-sky-500 transition border-r border-gray-300">
                                <x-phosphor-pencil-line-duotone class="inline-block w-5 h-5"/>
                            </button>
                            <button wire:click="deleteJobType({{ $type->id }})"
                                class="text-gray-400 hover:text-red-100 hover:bg-red-500 transition">
                                <x-phosphor-trash-duotone class="inline-block w-5 h-5"/>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                        <x-button wire:click="newJobType">
                            <i class="fa-solid fa-plus pr-2"></i>
                            Add first Type
                        </x-button>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-planner.section>

    {{-- Modal for add and update record --}}
    <x-dialog-modal id="recordModal"
                    wire:model.live="showModal">
        <x-slot name="title">
            <h2>{{ is_null($form->id) ? 'New Job Type' : 'Edit Job Type' }}</h2>
        </x-slot>
        <x-slot name="content">
            {{-- error messages --}}
            @if ($errors->any())
                <x-planner.alert type="danger">
                    <x-planner.list>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </x-planner.list>
                </x-planner.alert>
            @endif

            {{-- form content --}}
            <div class="flex flex-row gap-4 mt-4">
                <div class="flex-1 flex-col gap-2" x-data="{ color: '#' }">
                    <label for="jobName">Name Of Job Type</label>
                    <x-input id="jobName" type="text"
                             wire:model="form.name"
                             class="mt-1 block w-full"/>
                    <label for="jobName" class="block mt-5">color (hex)</label>
                    <x-input id="jobName" type="text"
                             x-model="color"
                             wire:model="form.color"
                             class="mt-1 inline w-1/2"/>
                    <div x-show="color" :style="'background-color: ' + color"
                        class="inline p-3 border border-blue-600 rounded">
                        Color: <span x-text="color"></span>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="$wire.showModal = false">Cancel</x-secondary-button>
            @if(is_null($form->id))
                <x-button wire:click="createJobType()"
                          class="ml-2">Create Job Type</x-button>

            @else
                <x-button wire:click="updateJobType({{ $form->id }})"
                          class="ml-2">Save Changes</x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
