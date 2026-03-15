<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap"
      rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
  </head>

  <body class="flex h-screen">
    <livewire:app-menu />

    <div class="flex-1 min-w-0 flex flex-col">
      <livewire:app-header :$title />

      <hr class="mx-6">

      <main class="flex-1">
        {{ $slot }}
      </main>
    </div>
    @livewireScripts
  </body>

</html>
