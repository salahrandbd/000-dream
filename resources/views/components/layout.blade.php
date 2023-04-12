<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/images/cloud-moon-fill.ico') }}" />
    <title>Dream | Track Things Eloquently</title>
    @vite('resources/js/app.js')
  </head>
  <body class="bg-light">
    <x-topbar/>
    <main class="position-relative d-flex align-items-stretch">
      @auth <x-sidebar/> @endauth
      <div class="site-content container-fluid">
        {{ $slot }}
      </div>
    </main>
    <x-flash-message/>
  </body>
</html>
