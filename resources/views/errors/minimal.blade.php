<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-screen flex flex-col justify-center items-center bg-black"
        style="background-image: url('{{ asset('assets/images/bg_img.png') }}'); background-size: cover; background-position: center;">

        <div class="w-full sm:max-w-md md:max-w-[700px] px-6">

            <div class="pop-window p-8 text-center flex flex-col items-center">

                <div class="w-full h-48 mb-6 rounded-lg border-2 border-orange-950 shadow-inner"
                    style="background-image: url('{{ asset('assets/images/error_image.png') }}'); 
                            background-size: cover; background-position: center;">
                </div>

                <div class="flex flex-col items-center justify-center">
                    <h1 class="text-4xl font-bold text-gray-600 tracking-tighter mb-2">
                        @yield('code', '404')
                    </h1>

                    <div class="text-xl text-gray-600 uppercase tracking-widest ">
                        @yield('message', __('Page Not Found'))
                    </div>
                </div>

                <a href="{{ url('/') }}" class="go-button  active:scale-95 transition-all text-center">
                    RETURN TO BASE
                </a>
            </div>

        </div>
    </div>
</body>

</html>
