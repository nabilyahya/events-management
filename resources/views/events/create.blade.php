{{-- resources/views/events/create.blade.php --}}

@extends('layouts.app') 

@section('content')
<div class="container mx-auto  mt-8 " style="width:70%;">
    <div class="px-4 bg-white shadow-md rounded-lg">

  
    <h2 class="text-2xl font-semibold leading-tight py-6 px-4">
        Create Event
    </h2>
    <form action="{{ route('events.store') }}" method="POST" class="space-y-6 p-4">
        @csrf {{-- CSRF token is required for form submissions for security --}}

        <div>
            <label for="eventName" class="block text-sm font-medium text-gray-700">Event Name</label>
            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="eventName" name="name" required>
        </div>

        <div>
            <label for="eventDescription" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="eventDescription" name="description" rows="3"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="startTime" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="datetime-local" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="startTime" name="start_time" required>
            </div>

            <div>
                <label for="endTime" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="datetime-local" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="endTime" name="end_time" required>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" style="padding-left:50px; padding-right:50px; margin-bottom:40px;">Submit</button>
        </div>
    </form>
</div>
<div class="mt-8 px-4 bg-white shadow-md rounded-lg">
    <h3 class="text-xl font-semibold leading-tight py-4">Event List</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Event Name</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Start Time</th>
                    <th scope="col" class="px-6 py-3">End Time</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $event->name }}</td>
                    <td class="px-6 py-4">{{ $event->description }}</td>
                    <td class="px-6 py-4">{{ $event->start_time }}</td>
                    <td class="px-6 py-4">{{ $event->end_time }}</td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
        }).showToast();
        @endif

        @if (session('error'))
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
            }
        }).showToast();
        @endif
    });
</script>
@endsection