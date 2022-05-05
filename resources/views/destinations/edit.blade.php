@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-5">
    <h1 class="text-xl font-bold">Edit Destination</h1>
</div>

<form class="max-w-2xl" method="post" action="{{ route('destination.update', $destination->id) }}">
    @csrf
    @method('PUT')
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="name" class="input @error('name') input-error @enderror" placeholder="Name" value="{{ old('name') ?? $destination->name }}" />
        <label for="name" class="input-label @error('name') input-error-label @enderror">Name</label>
        @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="location" class="input @error('location') input-error @enderror" placeholder="Location" value="{{ old('location') ?? $destination->location }}" />
        <label for="location" class="input-label @error('location') input-error-label @enderror">Location</label>
        @error('location')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="flex space-x-2">
        <div class="relative z-0 w-1/2 mb-6 group">
            <input type="date" name="date" class="input @error('date') input-error @enderror" value="{{ old('date') ?? $destination->date }}" />
            <label for="date" class="input-label @error('date') input-error-label @enderror">Date</label>
            @error('date')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="relative z-0 w-1/2 mb-6 group">
            <input type="time" name="time" class="input @error('time') input-error @enderror" value="{{ old('time') ?? Carbon\Carbon::parse($destination->time)->format('H:i') }}" />
            <label for="time" class="input-label @error('time') input-error-label @enderror">Time</label>
            @error('time')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

@endsection
