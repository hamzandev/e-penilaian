{{-- user account dropdown --}}
<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex flex-row-reverse lh-1 text-reset p-0" data-bs-toggle="dropdown"
        aria-label="Open user menu">
        <span class="avatar avatar-sm"
            style="background-image: url({{ Session::get('user')[0]->avatar ?? asset('assets/img/avatar.jpg') }})"></span>
        <div class="d-none d-xl-block pe-2 text-end">
            <div>{{ Auth::user()->name ?? "User" }}</div>
            <div class="mt-1 small text-secondary">{{ Auth::user()->email ?? "email" }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
        <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
        <div class="dropdown-divider"></div>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-small" class="dropdown-item">Logout</a>
    </div>
</div>
