<x-app-layout title="Edit Guru : {{ $teacher->nuptk }}">
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('info'))
                <x-alert type="info" message="{{ Session::get('info') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif

            @if (!$teacher->user_id)
                <div class="alert alert-info">
                    <p>INFO : Akun ini belum terkait dengan Data Guru
                        manapun. Anda bisa mengaitkan akun dengan data guru <a
                            href="{{ route('manage-users.connect-account', $teacher->id) }}"
                            style="text-decoration: underline">disini</a> </p>
                </div>
            @endif

            <div class="card shadow">
                <div
                    class="card-header d-flex flex-md-row flex-column gap-md-0 gap-3 align-items-baseline justify-content-between">
                    <a href="{{ route('master-data.teacher.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Edit Guru : <span class="badge bg-primary text-white">{{ $teacher->nuptk }}</span></h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <span class="text-info">Tanda <span class="text-danger">(*)</span> Menyatakan field
                                        wajib diisi.</span>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('master-data.teacher.update', $teacher->id) }}"
                            class="row">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="name">Nama Guru</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') ?? $teacher->name }}"
                                        placeholder="ex: XI">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="nuptk">NUPTK (Nomor Induk)</label>
                                    <input type="number" class="form-control @error('nuptk') is-invalid @enderror"
                                        name="nuptk" id="nuptk" value="{{ old('nuptk') ?? $teacher->nuptk }}"
                                        placeholder="ex: XI">
                                    @error('nuptk')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="gender">Jenis Kelamin</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                        id="gender">
                                        <option value="0">-- Select Gender --</option>
                                        @foreach ($gender as $g)
                                            <option {{ $teacher->gender == $g ? 'selected' : '' }}
                                                value="{{ $g }}">{{ $g }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label class="form-label required" for="dob">Tanggal Lahir</label>
                                            <input value="{{ date('d M Y', strtotime($teacher->dob)) }}" type="text"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-5">
                                            <label class="form-label required" for="dob">Edit</label>
                                            <input type="date"
                                                class="form-control @error('dob') is-invalid @enderror" name="dob"
                                                id="dob">
                                            @error('dob')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Alamat</label>
                                    <textarea name="address" value="{{ old('address') }}" placeholder="Alamat" id="address" cols="30" rows="5"
                                        class="form-control">{{ old('address') ?? $teacher->address }}</textarea>
                                </div>
                            </div>





                    </div>
                    <div class="card-header">
                        <div class="d-flex justify-content-end w-full">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                    @if (!$teacher->user_id)
                        <div class="row">
                            <div class="col-12">
                                <div class="my-3">
                                    <h2>Akun Guru</h2>
                                    <p class="text-info">*Info : Sepertinya Guru ini belum memiliki akun. Silahkan
                                        buat
                                        akun untuk guru ini jika diperlukan.</p>
                                </div>
                                <div class="d-md-flex w-full gap-5 align-items-center">
                                    <div class="mb-3">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modal-create-teacher-account"
                                            class="btn btn-outline-success">Buat Akun Guru</a>
                                    </div>
                                    <p class="text-secondary">ATAU</p>
                                    <div class="mb-3">
                                        <a href="{{ route('manage-users.connect-account', $teacher->id) }}"
                                            class="btn btn-outline">Kaitkan dengan Akun terdaftar</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{-- modal kaitkan akun --}}
    <div class="modal modal-blur fade" id="modal-connect-account" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Kaitkan Guru</h3>
                </div>
                <form class="modal-body" action="{{ route('manage-users.connect-account', $teacher->id) }}"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row mt-4">
                        <div class="col px-5">
                            <p class="text-secondary">Kaitkan data Guru dengan akun yang telah terdaftar sebelumnya</p>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Pilih Akun</label>
                                <div class="input-group mb-2">
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="0">-- Select user account --</option>
                                        <option value="1">Useer 1</option>
                                        <option value="1">Useer 2</option>
                                    </select>
                                    <button type="submit" class="btn btn-success">Kaitkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger me-auto" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal crate account guru --}}
    <div class="modal modal-blur fade" id="modal-create-teacher-account" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Buat Akun Guru</h2>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label required" for="email">Email</label>
                            <input type="email" class="form-control" name="email" autocomplete="off"
                                id="email" value="{{ old('email') }}" placeholder="ex: XI">
                            @error('email')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label required" for="password">Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off"
                                id="password" value="{{ old('password') }}" placeholder="ex: XI">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="role" class="form-label required">Peran (Role)</label>
                            <select class="form-control" name="role" id="role">
                                <option value="0">-- Select Role --</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Buat Akun Guru</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
