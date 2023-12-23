<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title }}</title>

    <meta name="msapplication-TileColor" content="#0054a6" />
    <meta name="theme-color" content="#0054a6" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <x-css-loader></x-css-loader>
</head>

<body>
    <div class="page">
        <!-- Navbar -->
        <div class="sticky-top">
            <x-header></x-header>
            @auth
                <x-menubar></x-menubar>
            @endauth
        </div>
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl d-flex flex-column justify-content-center">
                    {{ $slot }}
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>
    {{-- Logout modal --}}
    <div class="modal modal-blur fade" id="modal-small" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Are you sure?</div>
                    <div>If you proceed, you need to login again.</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="modal-footer">
                    @csrf
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        Logout Anyway
                    </button>
                </form>
            </div>
        </div>
    </div>
    <x-js-loader></x-js-loader>
</body>

</html>
