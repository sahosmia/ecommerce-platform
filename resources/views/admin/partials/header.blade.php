<header class="h-16 bg-white shadow flex items-center justify-between px-6 border-b border-gray-200">

    {{-- Sidebar Toggle --}}
    <button id="sidebar-toggle" class="text-gray-600 hover:text-gray-900 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    {{-- User Dropdown --}}
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <span class="text-gray-700 text-sm font-medium">{{ Auth::user()->name }}</span>
            <img class="w-9 h-9 rounded-full object-cover border border-gray-200" src="https://i.pravatar.cc/150?img=1"
                alt="Profile">
        </button>

        <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 border border-gray-100">

            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>



            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-50 border-t border-gray-100">
                    Logout
                </a>
            </form>
        </div>
    </div>
</header>
