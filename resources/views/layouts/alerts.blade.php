@if (session()->has('success'))
    <div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        {{ session()->get('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        {{ session()->get('error') }}
    </div>
@endif
