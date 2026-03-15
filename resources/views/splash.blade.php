<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-black m-0 p-0 overflow-hidden">

    <div class="loader transition-opacity duration-1000">
        <div id="splash-screen" class="fixed inset-0 w-screen h-screen flex justify-center items-center bg-black">

            <picture class="w-full h-full">
                <source media="(min-width: 1024px)" srcset="{{ asset('build/assets/images/APIT_cover_desktop.png') }}">
                <source media="(min-width: 768px)" srcset="{{ asset('build/assets/images/APIT_cover_tablet.png') }}">

                <img src="{{ asset('build/assets/images/APIT_cover_mobile.png') }}" alt="Welcome"
                    class="w-full h-full object-cover object-center block">
            </picture>

        </div>
    </div>
    <script>
        setTimeout(function() {
            document.querySelector('.loader').style.opacity = '0';

            setTimeout(function() {
                window.location.href = "/welcome";
            }, 1000);
        }, 4000);
    </script>
</body>

</html>
