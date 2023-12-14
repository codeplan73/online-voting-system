<x-app-layout>



    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Election!',
                    text: '{{ session('message') }}'
                })
            });
        </script>
    @endif




    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Elections') }}
        </h2>
        <a href="/election-create"
            class="rounded px-2 py-1 bg-red-400 text-white hover:bg-slate-700 hover:text-white">Schedule Election</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container my-8 px-8 bg-slate-100 flex flex-col gap-4">
                <h4 class="font-bold text-xl">List of Scheduled Elections</h4>
                <div class="overflow-x-auto">
                    <table id="userTable" class="min-w-full table-auto bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>End Date</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elections as $election)
                                <tr>
                                    <td class="py-2 px-4 text-center border-b">{{ $election->position }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $election->start_date }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $election->start_time }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $election->end_date }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $election->end_time }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $election->status }}</td>
                                    <td class="py-2 px-4 text-center border-b">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="/election/{{ $election->id }}/edit" class="btn btn-link p-0"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <span class="text-500 fas fa-edit"></span>
                                            </a>
                                            <form action="/election/{{ $election->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link p-0 ms-2" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Delete"><span
                                                        class="text-500 fas fa-trash-alt"></span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
