<x-app-layout>

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Position!',
                    text: '{{ session('message') }}'
                })
            });
        </script>
    @endif

    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Candidate Application List') }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="container my-8 px-8 bg-slate-100 flex flex-col gap-4">
                <h4 class="font-bold text-xl">Candidate List</h4>
                <div class="overflow-x-auto">
                    <table id="userTable" class="min-w-full table-auto bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Party</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $position)
                                <tr>
                                    <td class="py-2 px-4 text-center border-b">{{ $position->name }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $position->position }}</td>
                                    <td class="py-2 px-4 text-center border-b"> {{ $position->party }}</td>
                                    <td class="py-2 px-4 text-center border-b"> {{ $position->status }}</td>
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="/candidate/{{ $position->id }}/edit" class="btn btn-link p-0"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <span class="text-500 fas fa-edit"></span>
                                            </a>
                                            <form action="/candidate/{{ $position->id }}" method="post">
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
