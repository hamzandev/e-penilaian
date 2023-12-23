<x-app-layout title="{{ Auth::user()->name }}">
    @if (Session::has('message'))
        <x-alert type="success" message="{{ Session::get('message') }}" />
    @elseif(Session::has('error'))
        <x-alert type="error" message="{{ Session::get('error') }}" />
    @endif
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Basic Setting</h4>
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('profile') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center {{ Str::contains(Request::path(), 'profile') ? 'active text-primary' : '' }}">Akun
                            Saya</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
