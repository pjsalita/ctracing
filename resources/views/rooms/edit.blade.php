@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-5">
    <h1 class="text-xl font-bold">Edit Building</h1>
</div>

<form class="max-w-2xl" method="post" action="{{ route('room.update', $room->id) }}">
    @csrf
    @method('PUT')
    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="bldgName" class="input @error('bldgName') input-error @enderror" placeholder="Building Name" value="{{ old('bldgName') ?? $room->bldgName }}" />
        <label for="bldgName" class="input-label @error('bldgName') input-error-label @enderror">Building Name</label>
        @error('bldgName')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="roomName" class="input @error('roomName') input-error @enderror" placeholder="Building Name" value="{{ old('roomName') ?? $room->roomName }}" />
        <label for="roomName" class="input-label @error('roomName') input-error-label @enderror">Room Name</label>
        @error('roomName')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

@endsection
