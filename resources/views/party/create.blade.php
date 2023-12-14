<x-app-layout>
    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Party Registration') }}
        </h2>
    </div>

    <div class="max-w-2xl mx-auto my-20">
        <form method="POST" action="{{ route('party.register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Party Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="leader" :value="__('Leader')" />
                <x-text-input id="leader" class="block mt-1 w-full" type="text" name="leader" :value="old('leader')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('leader')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="manifesto" :value="__('Manifesto')" />
                <x-text-input id="manifesto" class="block mt-1 w-full" type="text" name="manifesto" :value="old('manifesto')"
                    required autocomplete="manifesto" />
                <x-input-error :messages="$errors->get('manifesto')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ms-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>

    </div>


</x-app-layout>
