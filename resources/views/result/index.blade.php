@extends('layouts.app-candidate')

@section('content')
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Voting!',
                    text: '{{ session('error') }}'
                })
            });
        </script>
    @endif

    <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  mx-auto my-20">
        <h4 class="text-center mb-6 text-red-400 text-2xl font-bold">Election Result</h4>
        <hr>
        <img src="/img/voting.png" class="mx-auto rounded-full w-32 h-42 mt-20" alt="">
        <form method="POST" action="{{ route('result.store') }}" class="px-10">
            @csrf

            <div class="my-4">
                <x-input-label for="position" :value="__('Position')" />
                <select name="candidate_position"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                    id="" required>
                    <option value="">Select Position</option>
                    @foreach ($elections as $position)
                        @if (!empty($position->position))
                            <option value="{{ $position->position }}">{{ $position->position }}</option>
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Check Result') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
