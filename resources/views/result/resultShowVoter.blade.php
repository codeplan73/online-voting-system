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

    <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  mx-auto my-20">
        <h4 class="text-center mb-6 text-red-400 text-2xl font-bold">{{ $position }} Election Result Winner</h4>
        <hr>
        {{-- <img src="/img/voting.png" class="mx-auto rounded-full w-32 h-42 mt-20" alt=""> --}}

        {{-- {{ $voteResult }} --}}


        <div class="text-center">
            <h4 class="text-xl font-semibold">Candidate Name: {{ $voteResult->candidate_name }}</h4>
            <h4 class="text-xl font-semibold">Candidate Party: {{ $voteResult->candidate_party }}</h4>
            <h4 class="text-xl font-semibold">Number of Vote: {{ $voteResult->vote_count }}</h4>
        </div>

    </div>

</x-app-layout>
