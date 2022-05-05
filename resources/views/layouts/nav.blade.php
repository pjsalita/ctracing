<!-- This example requires Tailwind CSS v2.0+ -->
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <img class="block h-16 w-auto py-1" src="{{ asset('icon.png') }}" alt="Workflow">
                </div>
                <div class="ml-6 flex items-center">
                    <div class="flex space-x-4">
                        <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'menu-active' : 'menu-link' }}">
                            Users
                        </a>
                        <a href="{{ route('room.index') }}" class="{{ request()->routeIs('room.*') ? 'menu-active' : 'menu-link' }}">
                            Rooms
                        </a>
                        <a href="{{ route('destination.index') }}" class="{{ request()->routeIs('destination.*') ? 'menu-active' : 'menu-link' }}">
                            Destinations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
