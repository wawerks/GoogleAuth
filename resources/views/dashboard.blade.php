<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Increased font size to 3xl for more emphasis -->
                    <h3 class="font-semibold text-xl mb-4">{{ __("Your Account Information") }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Avatar Section -->
                        <div class="flex justify-center items-center">
                            <img src="{{ Auth::user()->avatar ?? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp&s=200' }}" 
                                 alt="User Avatar" 
                                 class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-md">
                        </div>

                        <!-- User Information Section -->
                        <div>
                            <h4 class="font-semibold text-xl mb-2">User Information</h4>
                            <div class="space-y-2">
                                <p><strong class="text-gray-600">Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong class="text-gray-600">Email:</strong> {{ Auth::user()->email }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
