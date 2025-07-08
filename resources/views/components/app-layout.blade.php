<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     {!! seo() !!}
    <title>{{ $title ?? 'Bulikakan' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles & Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "https://bulikakan.my.id",
      "logo": "https://bulikakan.my.id/favicon.png"
    }
    </script>
    <style>
        html,
        body {
            overflow-y: auto;
            overflow-x: hidden;
        }

        [x-cloak] {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        /* body {
            overflow-x: hidden;
        } */

        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.3s ease-out;
        }
    </style>
</head>

<body>
    @if (!Request::is('login', 'register', 'forgot-password', 'new-password', 'password-changed', 'reset-password*'))
    @include('includes.navbar')
    @endif

    <main class="p-2 min-h-screen lg:mb-20 md:mb-20 mb-20">
        {{ $slot }}
    </main>

    @if (!Request::is('reset-password*'))
    @include('includes.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    {{--
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.effect(() => {
                feather.replace()
            });
        });
    </script> --}}


    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.carouselSwiper', {
                loop: true,
                centeredSlides: true,
                spaceBetween: 10,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>

</body>

</html>