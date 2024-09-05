@props(['title' => 'LaraMovies'])
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __($title) }}</title>
    <script>
        let theme = localStorage.getItem('theme');
        if (theme  === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (theme  === 'light') {
            document.documentElement.classList.add('light');
        }
        window.addEventListener('load', () => {
            document.getElementById('loader').classList.add('hidden');
        });
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('logos/favicon.png') }}" type="image/png">
</head>
<body
      class="bg-light-background dark:bg-dark-background text-light-text-primary dark:text-dark-text-primary">
<header
    class="bg-light-element dark:bg-dark-element shadow-md dark:shadow-shadow-color border border-gray-300 dark:border-gray-700">
    <div x-data="{ opened: false }">
        <x-layout.desktop-nav/>
        <x-layout.mobile-nav/>
    </div>
</header>
<div class="h-fit relative overflow-hidden">
    <div id="loader" class="absolute bg-gray-400/25 inset-0 z-50">
        <div class="fixed top-1/2 left-1/2">
            <svg class="animate-spin" fill="none" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M4 24C4 35.0457 12.9543 44 24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/></svg>
        </div>
    </div>
    {{ $slot }}
</div>
</body>
</html>
