<!doctype html>
<html lang="en" class="bg-light-background dark:bg-dark-background text-light-text-primary dark:text-dark-text-primary">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="w-full sm:max-w-md mx-auto mt-20 sm:mt-72 px-6 py-4 bg-white dark:bg-dark-element shadow-md overflow-hidden sm:rounded-lg">
    {{ $slot }}
</div>
</body>
</html>
