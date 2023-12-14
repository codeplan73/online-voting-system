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
            {{ __('Manage Party') }}
        </h2>
        <a href="/candidate-create"
            class="rounded px-2 py-1 bg-red-400 text-white hover:bg-slate-700 hover:text-white">Apply for
            Position</a>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="container my-8 px-8 bg-slate-100 flex flex-col gap-4">
                <h4 class="font-bold text-xl">Positions You Applied for</h4>
                <div class="overflow-x-auto">
                    <table id="userTable" class="min-w-full table-auto bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $position)
                                <tr>
                                    <td class="py-2 px-4 text-center border-b">{{ $position->position }}</td>
                                    <td
                                        class="py-2 px-4 text-center border-b
    @if ($position->status === 'Rejected') text-red-800
    @elseif($position->status === 'Approved') text-green-700
    @elseif($position->status === 'Pending') text-yellow-600 @endif
">
                                        {{ $position->status }}
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
