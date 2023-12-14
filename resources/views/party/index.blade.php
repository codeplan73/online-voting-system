<x-app-layout>



    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Party!',
                    text: '{{ session('message') }}'
                })
            });
        </script>
    @endif




    <div class="px-8 py-4 bg-white drop-shadow-xl flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Party') }}
        </h2>
        <a href="/party-create" class="rounded px-2 py-1 bg-red-400 text-white hover:bg-slate-700 hover:text-white">Add
            Party</a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container my-8 px-8 bg-slate-100 flex flex-col gap-4">
                <h4 class="font-bold text-xl">List of Registered Parties</h4>
                <div class="overflow-x-auto">
                    <table id="userTable" class="min-w-full table-auto bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th>Part Name</th>
                                <th>Party Leader</th>
                                <th>Manifestor</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parties as $party)
                                <tr>
                                    <td class="py-2 px-4 text-center border-b">{{ $party->name }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $party->leader }}</td>
                                    <td class="py-2 px-4 text-center border-b">{{ $party->manifesto }}</td>
                                    <td class="py-2 px-4 text-center border-b">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="/party/{{ $party->id }}/edit" class="btn btn-link p-0"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <span class="text-500 fas fa-edit"></span>
                                            </a>
                                            <form action="/party/{{ $party->id }}" method="post">
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
