<x-app-layout title="Tambah Guru Baru">
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('master-data.teacher.store') }}" class="card shadow">
                @csrf
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
                    <h2>Tambah Guru Baru</h2>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="name">Nama Guru</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') }}" placeholder="ex: XI">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="nuptk">NUPTK (Nomor Induk)</label>
                                    <input type="number" class="form-control @error('nuptk') is-invalid @enderror"
                                        name="nuptk" id="nuptk" value="{{ old('nuptk') }}" placeholder="ex: XI">
                                    @error('nuptk')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="gender">Jenis Kelamin</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                        <option value="0">-- Select Gender --</option>
                                        @foreach ($gender as $g)
                                            <option {{ old('gender') == $g ? 'selected' : '' }} value="{{ $g }}">{{ $g }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="dob">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        name="dob" id="dob" value="{{ old('dob') }}" placeholder="ex: XI">
                                    @error('dob')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Alamat</label>
                                    <textarea name="address" value="{{ old('address') }}" placeholder="Alamat" id="address" cols="30" rows="5"
                                        class="form-control">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mt-3">
                                    <h2>Akun Guru</h2>
                                </div>
                                <div class="mb-3 ">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" id="show-account-field" type="checkbox">
                                        <span class="form-check-label">Buat akun untuk guru ini</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3" style="display: none;" id="account-field-container">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="email">Email</label>
                                    <input disabled type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" autocomplete="off" id="email" value="{{ old('email') }}"
                                        placeholder="ex: XI">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label required" for="password">Password</label>
                                    <input disabled type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" autocomplete="off" id="password" value="{{ old('password') }}"
                                        placeholder="ex: XI">
                                    @error('password')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label required">Peran (Role)</label>
                                    <select disabled class="form-control" name="role" id="role">
                                        <option value="0">-- Select Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="operator">Operator</option>
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


    <script>
        const toggle = document.querySelector('#show-account-field')
        const pwd = document.querySelector('#password')
        const role = document.querySelector('#role')
        const email = document.querySelector('#email')
        const accountFieldContainer = document.querySelector('#account-field-container')

        toggle.addEventListener('change', () => {
            if (toggle.checked) {
                console.log(toggle.checked, accountFieldContainer.style.display)
                accountFieldContainer.style.display = 'flex';
                pwd.disabled = false;
                role.disabled = false;
                email.disabled = false;
            } else {
                pwd.disabled = true;
                email.disabled = true;
                role.disabled = true;
                console.log(toggle.checked, accountFieldContainer.style.display)
                accountFieldContainer.style.display = 'none';
            }
        })
    </script>
</x-app-layout>
