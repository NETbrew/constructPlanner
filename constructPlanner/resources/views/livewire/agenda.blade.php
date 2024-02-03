<div class="p-4 sm:ml-44" x-data="{ open: false }">
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
         wire:loading>
        <x-planner.preloader class="bg-lime-700/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-planner.preloader>
    </div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="inline-block text-3xl uppercase font-bold text-gray-700 mb-3">Agenda</h1>
            <x-heroicon-o-information-circle @click="open = !open"
                                             class="inline-block pb-3 w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <div>
            <x-button wire:click="addWork">
                <i class="fa-solid fa-plus pr-2"></i>
                add work
            </x-button>
        </div>
        <div class="flex items-center">
            <button wire:click="getPreviousWeek" class="mr-3 hover:bg-gray-300 px-1 rounded"><i class="fa-solid fa-circle-chevron-left text-3xl text-gray-700"></i></button>
            <span class="font-bold uppercase">{{ $currentDate->addDays(1)->format('j F, Y') }}</span>
            <button wire:click="getNextWeek" class="ml-3 hover:bg-gray-300 px-1 rounded"><i class="fa-solid fa-circle-chevron-right text-3xl text-gray-700"></i></button>
        </div>
    </div>
    <div
        x-show="open"
        x-transition
        style="display: none"
        class="text-sky-900 bg-sky-50 border-t p-4">
        <x-planner.list type="ul" class="list-outside mx-4 text-sm">
            <h2 class="font-bold uppercase">info: colors</h2>
            @foreach($types as $type)
                <li class="list-none my-2 border rounded-2xl" style="background-color: {{ $type->color }}">
                    <p class="p-3 font-bold text-white">{{ $type->name }}</p>
                </li>
            @endforeach
        </x-planner.list>
    </div>
    <div class="bg-white border border-white rounded-2xl mt-5">
        <table class="w-full my-3">
            <colgroup>
                <col class="w-1/5">
                <col class="w-1/5">
                <col class="w-1/5">
                <col class="w-1/5">
                <col class="w-1/5">
            </colgroup>
            <thead class="uppercase">
            <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-center">
                @foreach($weekdays as $day)
                    <td class="py-4">
                        @if (!$day->isWeekend())
                            <span class="{{ $day->isToday() ? 'bg-gray-700 text-white p-3 rounded-full' : '' }}">{{ $day->format('d') }}</span>
                        @endif
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach($weekdays as $day)
                    <td>
                        @if (!$day->isWeekend())
                            @foreach($workJobs->where('date', $day->format('Y-m-d')) as $work)
                                <div wire:key="{{ $work->id }}" class="m-1">
                                    <div style="background-color: {{ $work->type->color }};" wire:click="readWork({{ $work->id }})" class="bg-gray-100 my-1 px-2 text-white rounded cursor-pointer">
                                        <p class="text-center text-sm pt-1">{{ $work->type->name }}</p>
                                        <p class="text-center font-bold pb-2">{{ $work->title }}</p>
                                        <p class="py-2"><span class="text-xs">address: </span>{{ $work->location }}</p>
                                        <p class="py-2"><span class="text-xs">tel: </span>{{ $work->telephone }}</p>
                                        <p class="py-2"><span class="text-xs">m2: </span>{{ $work->squaremeters }}</p>
                                        <div class="py-2"> {{-- maybe at an overflow --}}
                                            <p>
                                                <span class="text-xs block">note:</span>{{ $work->note }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>
        {{-- Modal --}}
        <x-dialog-modal id="WorkModal"
                        wire:model.live="showModal">
            <x-slot name="title">
                <h2>{{ is_null($form->id) ? 'New Work' : $form->title }}</h2>
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
                    <div class="flex-1 flex-col gap-2">
                        @if($info)
                            <p class="py-3"><span class="font-bold">Date:</span> <span class="block">{{ \Carbon\Carbon::parse($form->date)->format('j F Y') }}</span></p>
                            <p class="py-3"><span class="font-bold">Address:</span><span class="block"><a class="underline" href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($form->location) }}" target="_blank">{{ $form->location }} <i class="fa-solid fa-map pl-2"></i></a></span></p>
                            <p class="py-3"><span class="font-bold">Telephone n°:</span> <span class="block">{{ $form->telephone }}</span></p>
                            <p class="py-3"><span class="font-bold">Email:</span> <span class="block"><a class="underline" href="mailto:{{ $form->email }}">{{ $form->email }}<i class="fa-solid fa-arrow-up-right-from-square pl-2"></i></a></span></p>
                            <p class="py-3"><span class="font-bold">Surface:</span> <span class="block">{{ $form->squaremeters }} m2</span></p>
                            <p class="py-3"><span class="font-bold">Note:</span> <span class="block">{{ $form->note }}</span></p>
                        @else
                            <label for="title">Title</label>
                            <x-input id="title" type="text"
                                     wire:model="form.title"
                                     class="mt-1 block w-full"/>
                            <label for="type" class="pt-2">Job Type</label>
                            <x-planner.select wire:model="form.type_id" id="type_id" class="block mt-1 w-full">
                                <option value="">Select a Job Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </x-planner.select>
                            <label for="title" class="pt-2">Date</label>
                            <x-input id="title" type="date"
                                     wire:model="form.date"
                                     class="mt-1 block w-full"/>
                            <label for="squaremeters" class="pt-2">Squaremeters</label>
                            <x-input id="squaremeters" type="number"
                                     wire:model="form.squaremeters"
                                     class="mt-1 block w-full"/>
                            <label for="location" class="pt-2">Location</label>
                            <x-input id="location" type="text"
                                     wire:model="form.location"
                                     class="mt-1 block w-full"/>
                            <label for="telephone" class="pt-2">Telephone</label>
                            <x-input id="telephone" type="tel"
                                     wire:model="form.telephone"
                                     class="mt-1 block w-full"/>
                            <label for="email" class="pt-2">Email</label>
                            <x-input id="email" type="email"
                                     wire:model="form.email"
                                     class="mt-1 block w-full"/>

                            <label for="note" class="pt-2">Note</label>
                            <textarea wire:model="form.note" class="mt-1 block w-full rounded border-gray-300" name="note" id="note" rows="5" cols="40"></textarea>
                        @endif
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                @if($info)
                    <x-secondary-button @click="$wire.showModal = false">Done</x-secondary-button>
                @elseif(is_null($form->id))
                    <x-secondary-button class="ml-3" @click="$wire.showModal = false">Cancel</x-secondary-button>
                @else
                    <x-secondary-button class="ml-3" wire:click="readWork({{ $form->id }})">Cancel</x-secondary-button>
                @endif
                {{-- add a button --}}
                @if($info)
                    <x-button class="ml-3" wire:click="editWork({{ $form->id }})">edit Work</x-button>
                        <x-button class="ml-3 bg-red-500 hover:bg-red-800" wire:click="deleteWork({{ $form->id }})"><i class="fa-solid fa-trash pr-2"></i>Delete</x-button>
                @elseif(is_null($form->id))
                    <x-button class="ml-3" wire:click="createWork">Add Work</x-button>
                @else
                    <x-button class="ml-3" wire:click="updateWork({{ $form->id }})">Update Work</x-button>
                        <x-button class="ml-3 bg-red-500 hover:bg-red-800" wire:click="deleteWork({{ $form->id }})"><i class="fa-solid fa-trash pr-2"></i>Delete</x-button>
                @endif

            </x-slot>
        </x-dialog-modal>
    </div>
</div>
