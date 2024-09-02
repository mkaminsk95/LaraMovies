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

{{ $slot }}
</body>
</html>
