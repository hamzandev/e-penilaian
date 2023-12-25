<x-app-layout title="Tambah Akun Baru">
    <div class="row mb-5">
        <div class="col-md-8">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif

            <form method="POST" action="{{ route('accounts.update', $account->id) }}" class="card">
                @csrf
                @method('PUT')
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
                    <h2>Edit Akun</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                @if ($account->teacher)
                                    <div class="mb-5 alert alert-warning">
                                        Akun ini <b>TERKAIT</b> dengan Data Guru :
                                        <span class="badge bg-primary text-white">{{ $account->teacher->nuptk }}</span>
                                    </div>
                                @else
                                    <div class="mb-5 alert alert-info">Akun ini <b>TIDAK TERKAIT</b> dengan Data Guru manapun
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email Akun</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') ?? $account->email }}" id="email"
                                        placeholder="john@doe.com">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="role">Peran Akun</label>
                                    <select class="form-select @error('role') is-invalid @enderror" name="role"
                                        id="role">
                                        <option value="0" selected="">-- Select User Role --</option>
                                        @foreach ($role as $i => $k)
                                            <option {{ $k == $account->role ? 'selected' : '' }}
                                                value={{ $k }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <form class="card" action="{{ route('accounts.update-password', $account->id) }}" method="POST">
                <div class="card-header">
                    Ubah Password Akun
                </div>
                <div class="card-body">
                    <div>
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan Password baru"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button onclick="return confirm('Password Pewngguna akan diubah. Anda Yakin?')" type="submit"
                            class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-alert-triangle-filled" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z"
                                    stroke-width="0" fill="currentColor" />
                            </svg>Ubah Password Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
