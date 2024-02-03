<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <meta name="description" content="{{ $description ?? 'contractPlanner' }}">
    <title>{{  $title ?? 'contractPlanner' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div>
    <header>
        @livewire('dashboard-nav')
    </header>
    <main class="container mx-auto pt-4 flex-1">
        {{ $slot }}
    </main>
</div>
@stack('script')
</body>
</html>
