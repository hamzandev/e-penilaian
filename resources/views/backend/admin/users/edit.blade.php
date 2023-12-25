<x-app-layout title="Tambah Pengguna">
    <div class="row mb-5">
        <div class="col-md-8">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif

            <form method="POST" action="{{ route('manage-users.update', $user->id) }}" class="card">
                @csrf
                @method('PUT')
                <div class="card-header d-flex align-items-center justify-content-between">
                    <a href="{{ route('manage-users.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Edit Pengguna</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email Pengguna</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') ?? $user->email }}" id="email"
                                        placeholder="john@doe.com">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') ?? $user->teacher->name }}"
                                        placeholder="John Doe">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="row align-items-end">
                                    <div class="col-md-7">
                                        <div class="mb-2">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input value="{{ date('d M Y', strtotime($user->teacher->dob)) }}"
                                                type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="mb-2">
                                            <label for="dob" class="form-label">Edit</label>
                                            <input type="date" name="dob" id="dob" class="form-control"
                                                name="dob" id="dob"
                                                class="form-control @error('dob') is-invalid @enderror">
                                            @error('dob')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-info mb-3 d-block">Anda dapat mengubah Tanggal Lahir
                                            pengguna. Biarkan input ini kosong jika tidak ingin mengubah</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="gender">Jenis Kelamin</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                        id="gender">
                                        <option value="0" selected="">-- Select Gender --</option>
                                        @foreach ($gender as $i => $k)
                                            <option {{ $k == $user->teacher->gender ? 'selected' : '' }}
                                                value={{ $k }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="role">Peran Pengguna</label>
                                    <select class="form-select @error('role') is-invalid @enderror" name="role"
                                        id="role">
                                        <option value="0" selected="">-- Select User Role --</option>
                                        @foreach ($role as $i => $k)
                                            <option {{ $k == $user->role ? 'selected' : '' }}
                                                value={{ $k }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Alamat</label>
                                    <textarea class="form-control" name="address" id="address" rows="3">{{ old('address') ?? $user->teacher->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete_user"
                        class="btn btn-danger me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z"
                                stroke-width="0" fill="currentColor" />
                            <path
                                d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"
                                stroke-width="0" fill="currentColor" />
                        </svg>
                        Hapus Pengguna
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <form class="card" action="{{ route('manage-users.update-password', $user->teacher->user_id) }}"
                method="POST">
                <div class="card-header">
                    Ubah Password Pengguna
                </div>
                <div class="card-body">
                    <div>
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password"
                                placeholder="Masukkan Password baru"
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
                                class="icon icon-tabler icon-tabler-alert-triangle-filled" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z"
                                    stroke-width="0" fill="currentColor" />
                            </svg>Ubah Password Pengguna</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
