<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  <!-- Bootstrap 5 and icons for Sveltestrap -->
  <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
  />

  <!-- Scripts -->
  @routes
  @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.svelte"])
  @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
