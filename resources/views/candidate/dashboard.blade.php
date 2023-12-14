@extends('layouts.app-candidate')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Registration!',
                    text: '{{ session('message') }}'
                })
            });
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-100 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container my-8 px-8 bg-slate-100 flex flex-col gap-4">
                    <h4 class="font-bold text-xl">Account</h4>
                    <div class="overflow-x-auto">
                        {{-- <table id="userTable" class="min-w-full table-auto bg-white border border-gray-300">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Party</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $position)
                                    <tr>
                                        <td class="py-2 px-4 text-center border-b">{{ $position->position }}</td>
                                        <td class="py-2 px-4 text-center border-b">{{ $position->party }}</td>
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
                        </table> --}}
                    </div>
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
@endsection
