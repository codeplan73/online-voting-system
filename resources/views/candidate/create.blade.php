{{-- @extends('layouts.app-candidate')

@section('content')
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Position!',
                    text: '{{ session('error') }}'
                })
            });
        </script>
    @endif

    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Candidate Application Registration') }}
        </h2>
    </div>

    <div class="max-w-2xl mx-auto my-20">
        <form method="POST" action="{{ route('candidate.create-position') }}" enctype="multipart/form-data">
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
                @include('components.file-upload')
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>

    </div>
@endsection --}}


@extends('layouts.app-candidate')

@section('content')
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Position!',
                    text: '{{ session('error') }}'
                })
            });
        </script>
    @endif

    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Candidate Application Registration') }}
        </h2>
    </div>

    <div class="max-w-2xl mx-auto my-20">
        <form method="POST" action="{{ route('candidate.create-position') }}" enctype="multipart/form-data">
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

            <div class="mb-4">
                <x-input-label for="certificate_pdf" :value="__('Certificate Image')" />
                <input type="file" name="certificate_pdf"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                    accept="image/*" onchange="previewImage(this)">
                <div class="mt-2">
                    <img id="preview" class="hidden" alt="Image Preview" style="max-width: 100%">
                </div>
                <x-input-error :messages="$errors->get('certificate_pdf')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('preview');
            preview.classList.remove('hidden');

            var file = input.files[0];

            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection
