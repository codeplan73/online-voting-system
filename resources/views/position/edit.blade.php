<x-app-layout>
    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Part Details') }}
        </h2>
    </div>

    <div class="max-w-2xl mx-auto my-20">
        <form action="/position/{{ $position->id }}" method="post">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Position Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ $position->name }}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ms-4">
                    {{ __('Update Position') }}
                </x-primary-button>
            </div>
        </form>

    </div>


</x-app-layout>
