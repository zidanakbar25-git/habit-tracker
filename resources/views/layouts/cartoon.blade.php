<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Habit Tracker') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    <div class="max-w-6xl mx-auto px-4 py-6">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-indigo-700">
                🌱 {{ config('app.name', 'Habit Tracker') }}
            </h1>
            <p class="text-sm text-gray-500">
                Pelan-pelan, yang penting jalan ✨
            </p>
        </div>

        <!-- CONTENT -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
