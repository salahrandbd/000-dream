<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/images/cloud-moon-fill.ico') }}" />
    <title>Dream | Track things organizedly</title>
    @vite('resources/js/app.js')
  </head>
  <body data-topbar="dark" class="bg-light">
    <x-navbar/>

    {{ $slot }}
  </body>
</html>
