<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="/images/logo2.png" class="rounded-full">
    <!-- Scripts -->
    @routes
    
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    
    @inertiaHead
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <style>
        
        .disable-scrollbars {
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE 10+ */
        }
        html {
scroll-behavior: smooth;
}

        .disable-scrollbars::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari/Webkit */
        }
    </style>
    
</head>

<body class="disable-scrollbars scroll-smooth font-sans antialiased bg-snow dark:bg-oynx">
    @inertia

</body>

</html>
