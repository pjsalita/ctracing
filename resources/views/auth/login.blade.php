@extends('layouts.app')

@section('content')
<form class="max-w-sm m-auto" method="post" action="{{ route('login') }}">
    @csrf
    <div class="relative z-0 w-full mb-6 group">
        <input type="email" name="email" class="input @error('email') input-error @enderror" placeholder="Email" value="{{ old('email') }}" />
        <label for="email" class="input-label @error('email') input-error-label @enderror">Email</label>
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="relative z-0 w-full mb-6 group">
        <input type="password" name="password" class="input @error('password') input-error @enderror" placeholder="Password" />
        <label for="password" class="input-label @error('password') input-error-label @enderror">Password</label>
        @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                {{ $message }}
            </p>
        @enderror
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Login
    </button>
</form>
@endsection
