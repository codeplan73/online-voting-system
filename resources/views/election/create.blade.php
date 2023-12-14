<x-app-layout>
    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule New Election Date') }}
        </h2>
    </div>

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Election!',
                    text: '{{ session('error') }}'
                })
            });
        </script>
    @endif

    <div class="max-w-2xl mx-auto my-20">
        <form method="POST" action="{{ route('election.store') }}" class="flex flex-col gap-4 py-4">
            @csrf

            <div class="my-4">
                <x-input-label for="position" :value="__('Position')" />
                <select name="position"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                    id="">
                    <option value="">Select Position</option>
                    @foreach ($positions as $position)
                        @if (!empty($position->name))
                            <option value="{{ $position->name }}">{{ $position->name }}</option>
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>


            <div>
                <x-input-label for="start_date" :value="__('Start Date')" />
                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                    :value="old('start_date')" required autofocus autocomplete="start_date" />
                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="start_time" :value="__('Start Time')" />
                <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                    :value="old('start_time')" required autofocus autocomplete="start_time" />
                <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="end_date" :value="__('End Date')" />
                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')"
                    required autofocus autocomplete="end_date" />
                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="end_time" :value="__('End Time')" />
                <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="old('end_time')"
                    required autofocus autocomplete="end_time" />
                <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select name="status"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                    id="">
                    <option value="">Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ms-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>

    </div>


</x-app-layout>
