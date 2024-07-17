<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="https://bexsoluciones.com/wp-content/uploads/2018/10/fav.png" type="image/x-icon" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    @vite('resources/css/app.css')
</head>

<script>
    window.appConfig = {  baseUrl: "{{ config('app.url') }}" };
</script>

<body class="bg-gray-100">

    <!--Sección html donde se el Header -->
    <header class="bg-white p-4 shadow-md" >
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <img src="https://bexsoluciones.com/wp-content/uploads/thegem-logos/logo_503933ec6e6cdd29c01200cb48e0e01a_1x.png"
                    alt="Logo" class="h-12">
            </div>
            <nav class="hidden md:flex md:space-x-6">
                <a href="#" class="menu-link"> <i class="fa-solid fa-chevron-right sizeIcon"></i> INICIO </a>
                <a href="https://bexsoluciones.com/quienes-somos/" class="menu-link"> <i
                        class="fa-solid fa-chevron-right sizeIcon"></i> Quiénes Somos</a>
                <a href="https://bexsoluciones.com/quienes-somos/equipo-bex-soluciones/" class="menu-link"> <i
                        class="fa-solid fa-chevron-right sizeIcon"></i> Nuestro Equipo</a>
                <a href="https://bexsoluciones.com/productos/" class="menu-link"> <i
                        class="fa-solid fa-chevron-right sizeIcon"></i> Productos</a>
                <a href="https://bexsoluciones.com/quienes-somos/trabaje-con-nosotros/" class="menu-link"> <i
                        class="fa-solid fa-chevron-right sizeIcon"></i> Trabaje con Nosotros</a>
                <a href="https://bexsoluciones.com/contactanos/" class="menu-link"> <i
                        class="fa-solid fa-chevron-right sizeIcon"></i> Contáctenos</a>
            </nav>
            <button class="text-gray-600 focus:outline-none md:hidden">
                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M10 2a8 8 0 106.32 12.9l4.26 4.26-1.42 1.42-4.26-4.26A8 8 0 0010 2zm0 2a6 6 0 110 12A6 6 0 0110 4z" />
                </svg>
            </button>
            
        </div>
        <nav class="md:hidden mt-4 flex flex-col items-center">
            <a href="#" class="menu-link"> <i class="fa-solid fa-chevron-right sizeIcon"></i> INICIO </a>
            <a href="https://bexsoluciones.com/quienes-somos/" class="menu-link"> <i
                    class="fa-solid fa-chevron-right sizeIcon"></i> Quiénes Somos</a>
            <a href="https://bexsoluciones.com/quienes-somos/equipo-bex-soluciones/" class="menu-link"> <i
                    class="fa-solid fa-chevron-right sizeIcon"></i> Nuestro Equipo</a>
            <a href="https://bexsoluciones.com/productos/" class="menu-link"> <i
                    class="fa-solid fa-chevron-right sizeIcon"></i> Productos</a>
            <a href="https://bexsoluciones.com/quienes-somos/trabaje-con-nosotros/" class="menu-link"> <i
                    class="fa-solid fa-chevron-right sizeIcon"></i> Trabaje con Nosotros</a>
            <a href="https://bexsoluciones.com/contactanos/" class="menu-link"> <i
                    class="fa-solid fa-chevron-right sizeIcon"></i> Contáctenos</a>
        </nav>          
    </header>

   <!--Sección html para pintar el Mapa -->
   <div class="max-w-7xl mx-auto p-1 lg:p-8" id="app"></div>

    <!--Sección html donde se renderiza el Footer -->
    <footer class="bg-[#181828] py-4 mt-8">
        <div class="container mx-auto text-center">
            <nav class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4 text-gray-400">
                <span>2022 © Copyright BEX Soluciones</span>
                <span class="hidden md:inline">|</span>
                <a href="#" class="footer-link">Soporte</a>
                <span class="hidden md:inline">|</span>
                <a href="#" class="footer-link">Contáctanos</a>
                <span class="hidden md:inline">|</span>
                <a href="#" class="footer-link">Aviso de Privacidad</a>
                <div class="socials inline-inside socials-colored flex justify-center space-x-4 mt-4">
                    <a href="http://www.facebook.com/bexsolucioneslatam" target="_blank" title="Facebook"
                        class="socials-item">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/business-ecosystem-experience-s-a-s" target="_blank"
                        title="LinkedIn" class="socials-item">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="http://www.instagram.com/bexsolucioneslatam" target="_blank" title="Instagram"
                        class="socials-item">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://bexsoluciones.com/contactanos/" target="_blank" title="YouTube" class="socials-item">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://bexsoluciones.com/contactanos/" target="_blank" title="WhatsApp" class="socials-item">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </nav>
        </div>
    </footer>

    @vite('resources/js/app.js')
</body>

</html>