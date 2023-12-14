<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Vote!',
                    text: '{{ session('message') }}'
                })
            });
        </script>
    @endif
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

    <div class="py-12">
        @if (Auth::user()->level == 'admin')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-slate-100 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 p-6">
                        <div
                            class="flex flex-col bg-white items-center rounded-lg px-4 py-2 shadow-xl hover:drop-shadow-xl gap-4">
                            <img src="" alt="">
                            <h4 class="text-lg font-bold">Registered Voters</h4>
                            <h4 class="text-2xl font-extrabold">{{ $users->count() }}</h4>
                        </div>
                        <div
                            class="flex flex-col bg-white items-center rounded-lg px-4 py-2 shadow-xl hover:drop-shadow-xl gap-4">
                            <img src="" alt="">
                            <h4 class="text-lg font-bold">Registered Candidate</h4>
                            <h4 class="text-2xl font-extrabold">{{ $candidatePosition->count() }}</h4>
                        </div>
                        <div
                            class="flex flex-col bg-white items-center rounded-lg px-4 py-2 shadow-xl hover:drop-shadow-xl gap-4">
                            <img src="" alt="">
                            <h4 class="text-lg font-bold">Registered Parties</h4>
                            <h4 class="text-2xl font-extrabold">{{ $party->count() }}</h4>
                        </div>
                        <div
                            class="flex flex-col bg-white items-center rounded-lg px-4 py-2 shadow-xl hover:drop-shadow-xl gap-4">
                            <img src="" alt="">
                            <h4 class="text-lg font-bold">Confirmed Applications</h4>
                            <h4 class="text-2xl font-extrabold">{{ $confirmedApplication->count() }}</h4>
                        </div>
                    </div>

                    <div class="container my-8 px-8 bg-slate-100 flex flex-col gap-4">
                        <h4 class="font-bold text-xl">List of Registered Voters</h4>
                        <div class="overflow-x-auto">
                            <table id="userTable" class="min-w-full table-auto bg-white border border-gray-300">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="py-2 px-4 text-center border-b">{{ $user->name }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $user->email }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $user->contact }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $user->gender }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $user->age }}</td>
                                            {{-- <td class="py-2 px-4 text-center border-b">
                                                <a class="text-slate-950 border border-blue-600 rounded px-2 py-1"
                                                    href="/users/{{ $user->id }}/edit">Edit</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        @else
            <div class="w-6/12 h-6/12 mx-auto">
                <h4 class="text-center font-extrabold font-mono text-red-400 text-2xl mb-5">Online Voting System</h4>
                <img src="/img/voting_system.png" class="w-full h-full" alt="">
            </div>
        @endif

    </div>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
            });
        });
    </script>
</x-app-layout>
