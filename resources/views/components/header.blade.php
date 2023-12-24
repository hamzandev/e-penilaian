<header class="navbar navbar-expand-md sticky-top d-print-none border-none shadow-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/">
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="32"
                    height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                </svg>
                <span>E-Raport</span>
            </h1>
        </a>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <x-theme-toggler></x-theme-toggler>
            </div>
            @auth
                <x-account-dropdown></x-account-dropdown>
            @endauth
        </div>
    </div>
</header>
