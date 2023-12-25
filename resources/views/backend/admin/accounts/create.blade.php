<x-app-layout title="Tambah Akun Baru">
    <div class="row mb-5">
        <div class="col-md-7">
            @if (Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif
            <form method="POST" action="{{ route('accounts.store') }}" class="card">
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between">
                    <a href="{{ route('accounts.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Buat Akun Baru</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email Akun</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" id="email"
                                        placeholder="john@doe.com">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="role">Peran Akun</label>
                                    <select class="form-select @error('role') is-invalid @enderror" name="role"
                                        id="role">
                                        <option value="0" selected="">-- Select User Role --</option>
                                        @foreach ($role as $i => $k)
                                            <option {{ $k == old('role') ? 'selected' : '' }}
                                                value={{ $k }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password Akun</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <small class="text-info d-block mt-2">Info : Apabila dikosongkan, password default
                                        Akun
                                        adalah <b class="badge bg-info text-white">12345678</b></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
