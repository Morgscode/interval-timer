<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 md:p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-6 text-4xl">Welcome back {{ $user->name ? $user->name : '!' }}</h1>
                    @include ('components.user-profile')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
