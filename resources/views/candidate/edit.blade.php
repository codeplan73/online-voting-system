<x-app-layout>
    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Part Details') }}
        </h2>
    </div>

    <div class="max-w-2xl mx-auto my-20">
        <form action="/candidate/{{ $candidate->id }}" method="post">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Candidate Name')" />
                <x-text-input id="name" readonly class="block mt-1 w-full" type="text" name="name"
                    value="{{ $candidate->name }}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="position" :value="__('Candidate Position')" />
                <x-text-input readonly id="position" class="block mt-1 w-full" type="text" name="position"
                    value="{{ $candidate->position }}" required autofocus autocomplete="position" />
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="party" :value="__('Candidate Party')" />
                <x-text-input readonly id="party" class="block mt-1 w-full" type="text" name="party"
                    value="{{ $candidate->party }}" required autofocus autocomplete="party" />
                <x-input-error :messages="$errors->get('party')" class="mt-2" />
            </div>

            <div class="my-4">
                <x-input-label for="status" :value="__('Status')" />
                <select name="status"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                    id="">
                    <option value="{{ $candidate->status }}">{{ $candidate->status }}</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div>
                <img src="{{ asset('storage/' . $candidate->certificate_pdf) }}" alt="Certificate Image"
                    style="width: 100%; height: auto;">
            </div>


            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ms-4">
                    {{ __('Update Candidate') }}
                </x-primary-button>
            </div>
        </form>

    </div>

</x-app-layout>
