<x-app-layout>
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

    {{-- <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between mb-40">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vote Casting') }}
        </h2>
    </div> --}}



    {{-- <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  mx-auto my-20">
        <img src="/img/voting.png" class="mx-auto rounded-full w-32 h-42 mt-20" alt="">

       

    </div> --}}

    {{-- @if (now()->format('Y-m-d') == $startDate && now()->format('H:i:s') == $startTime) --}}
    @if (now()->format('Y-m-d') == $startDate)
        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  mx-auto my-20">
            <img src="/img/voting.png" class="mx-auto rounded-full w-32 h-42 mt-20" alt="">
            <form method="POST" action="{{ route('vote.storeVoterVote') }}" class="px-10" enctype="multipart/form-data">
                @csrf

                <div class="my-4">
                    <x-input-label for="position" :value="__('Position')" />
                    <select name="candidate_position"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                        id="" required>
                        <option value="">Select Position</option>
                        @foreach ($positions as $position)
                            @if (!empty($position->position))
                                <option value="{{ $position->position }}">{{ $position->position }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-input-label for="party" :value="__('Candidate')" />
                    <select name="candidate_name"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                        id="" required>
                        <option value="">Select Candidate</option>
                        @foreach ($candidates as $candidate)
                            @if (!empty($candidate->name))
                                <option value="{{ $candidate->name }}">{{ $candidate->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('party')" class="mt-2" />
                </div>

                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}" id="">
                <input type="hidden" name="candidate_party" value="{{ $candidate->party }}" id="">


                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Cast Your Vote') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    @else
        <div class="h-96 flex items-center justify-center">
            <h4 class="text-center font-extrabold text-4xl">There is no active election now!</h4>
        </div>
    @endif


</x-app-layout>
