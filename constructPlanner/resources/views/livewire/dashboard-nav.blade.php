<div>
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <img class="rounded-full h-16 w-16 cursor-pointer mx-auto"
                src="{{ $avatar }}"
                 alt="{{ auth()->user()->name }}">
            <div class="font-bold text-white text-center uppercase text-2xl mt-3">
                {{ Auth::user()->name }}
            </div>
        </div>

        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-planner.nav-link href="{{ route('agenda') }}" :active="request()->routeIs('agenda')">
                        @svg('bi-calendar-fill')
                        <span class="flex-1 ms-3 whitespace-nowrap">Agenda</span>
                    </x-planner.nav-link>
                </li>
                <li>
                    <x-planner.nav-link href="{{ route('types') }}" :active="request()->routeIs('types')">
                        <i class="fa-solid fa-list"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Job Types</span>
                    </x-planner.nav-link>
                </li>
                <li>
                    <x-planner.nav-link href="{{ route('settings') }}" :active="request()->routeIs('settings')">
                        <i class="fa-solid fa-gear"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
                    </x-planner.nav-link>
                </li>
                <li>
                    <x-planner.nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        <i class="fa-solid fa-user"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">profile</span>
                    </x-planner.nav-link>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}"
                           @click.prevent="$root.submit();"
                           class="flex items-center p-2 rounded-lg text-white bg-gray-500 group">
                            <i class="fa-solid fa-right-from-bracket pr-3"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </aside>
</div>


