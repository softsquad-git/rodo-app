<!doctype html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title')</title>

    <meta name="description"
          content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">

    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ public_path().'/apple-icon-57x57.png' }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ public_path().'/apple-icon-60x60.png' }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ public_path().'/apple-icon-72x72.png' }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ public_path().'/apple-icon-76x76.png' }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ public_path().'/apple-icon-114x114.png' }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ public_path().'/apple-icon-120x120.png' }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ public_path().'/apple-icon-144x144.png' }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ public_path().'/apple-icon-152x152.png' }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ public_path().'/apple-icon-180x180.png' }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ public_path().'/android-icon-192x192.png' }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ public_path().'/favicon-32x32.png' }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ public_path().'/favicon-96x96.png' }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ public_path().'/favicon-16x16.png' }}">
    <link rel="manifest" href="{{ public_path().'/manifest.json' }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url({{ asset('images/login_background.jpg') }});">
            <div class="row g-0 bg-primary-dark-op">
                <!-- Meta Info Section -->
                <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                    <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                        <div class="w-100">
                            <a class="link-fx fw-semibold fs-2 text-white" href="index.html">
                                Odo<span class="fw-normal">CRM</span>
                            </a>
                            <p class="text-white-75 me-xl-8 mt-2">
                                Witamy w aplikacji wspierającej procesy ochrony danych osobowych.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                        <p class="fw-medium text-white-50 mb-0">
                            PCCBIODO Sp. z o.o. &copy; {{ \Illuminate\Support\Carbon::now()->year }}
                        </p>
                        <ul class="list list-inline mb-0 py-2">
                            <li class="list-inline-item">
                                <a class="text-white-75 fw-medium" href="javascript:void(0)">Legal</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-white-75 fw-medium" href="javascript:void(0)">Contact</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-white-75 fw-medium" href="javascript:void(0)">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END Meta Info Section -->

                <!-- Main Section -->
                <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-light">
                    <div class="p-3 w-100 d-lg-none text-center">
                        <a class="link-fx fw-semibold fs-3 text-dark" href="index.html">
                            One<span class="fw-normal">UI</span>
                        </a>
                    </div>
                    @yield('content')
                    <div class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                        <p class="fw-medium text-black-50 py-2 mb-0">
                            <strong>OneUI 5.0</strong> &copy; <span data-toggle="year-copy"></span>
                        </p>
                        <ul class="list list-inline py-2 mb-0">
                            <li class="list-inline-item">
                                <a class="text-muted fw-medium" href="javascript:void(0)">Legal</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted fw-medium" href="javascript:void(0)">Contact</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted fw-medium" href="javascript:void(0)">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END Main Section -->
            </div>
        </div>
    </main>
</div>

</body>
</html>
