<!doctype html>
<html lang="en" class="bg-gray-100 dark:bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>About page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-600 border border-gray-300 dark:border-gray-700">
    <div x-data="{ opened: false }">
        <x-desktop-nav/>
        <x-mobile-nav/>
    </div>
</header>

    {{ $slot }}

</body>
</html>
