<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AR Guide</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <style type="text/tailwindcss">
            @layer utilities {
                .menu-active {
                    @apply bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium;
                }
                .menu-link {
                    @apply text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium;
                }
                .input {
                    @apply block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600;
                }
                .input-label {
                    @apply absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0];
                }
                .input-error-label {
                    @apply absolute text-sm text-red-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0];
                }
                .input-error {
                    @apply block py-2.5 px-0 w-full text-sm text-red-900 placeholder-red-700 bg-transparent border-0 border-b-2 border-red-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-600;
                }
            }
        </style>
    </head>
    <body class="p-0 m-0">
        @include('layouts.nav')

        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                @include('layouts.alerts')

                <div class="px-4 py-6 sm:px-0">
                    @yield('content')
                </div>
            </div>
        </main>
    </body>
</html>
