<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-hidden">

    <div class="h-screen flex flex-col justify-center items-center bg-black"
        style="background-image: url('{{ asset('build/assets/images/bg_img.png') }}'); background-size: cover; background-position: center; animate-fade-out">

        {{-- 
        <div id="splash-screen"
            class="fixed inset-0 z-10 flex items-center justify-center bg-black transition-opacity duration-700">
            <div class="text-center w-full h-full flex items-center justify-center p-6">

                <picture>
                    <source media="(min-width: 1024px)"
                        srcset="{{ asset('build/assets/images/APIT_cover_desktop.png') }}">

                    <source media="(min-width: 768px)"
                        srcset="{{ asset('build/assets/images/APIT_cover_tablet.png') }}">

                    <img src="{{ asset('build/assets/images/APIT_cover_mobile.png') }}" alt="Welcome"
                        class="max-w-full max-h-screen object-contain">
                </picture>

            </div>
        </div> --}}

        <div class="w-full sm:max-w-md md:max-w-[700px] px-6 py-4 ">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
