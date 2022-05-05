@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-5">
    <h1 class="text-xl font-bold">Destinations</h1>
    {{-- <a href="{{ route('destination.create') }}">
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5">Add</button>
    </a> --}}
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Time
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($destinations as $destination)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">
                        {{ $destination->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $destination->location }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Carbon\Carbon::parse($destination->date)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Carbon\Carbon::parse($destination->time)->format('h:iA') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="inline-flex rounded-md shadow-sm">
                            {{-- <a href="{{ route('destination.edit', $destination->id) }}" aria-current="page" class="py-2 px-4 text-sm font-medium text-blue-700 bg-white rounded-l-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                Edit
                            </a> --}}
                            <form action="{{ route('destination.delete', $destination->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-2 px-4 text-sm font-medium text-red-900 bg-white rounded-md border  border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b">
                    <td scope="row" class="px-6 py-4">
                        No records found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="px-6 py-3">
    {{ $destinations->links() }}
</div>

@endsection
