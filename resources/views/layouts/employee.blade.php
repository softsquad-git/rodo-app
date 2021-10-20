<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="description"
          content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
</head>
<body>
<div id="page-container"
     class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    @include('partials.navs.nav')
    @include('partials.header')
    <main id="main-container">
        @yield('content')
    </main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.js') }}"></script>
<script>
    $('.remove-form').click(function (e) {
        let $form = $(this).closest('form');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success w-150',
                cancelButton: 'btn btn-danger _mr-10 w-150'
            },
            buttonsStyling: false,
        })
        swalWithBootstrapButtons.fire({
            title: 'Czy na pewno?',
            text: 'Czy na pewno chcesz usunać dany element?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie',
            reverseButtons: true
        }).then((result) => {
            if(result.value) {
                $form.submit();
            }
        })
    })


</script>
<script>
    CKEDITOR.replaceClass = 'editor';
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.js-example-basic-multiple').select2()
</script>
@yield('customJs')
</body>
</html>
