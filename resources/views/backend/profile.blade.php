<x-setting-layout>
    <form action="{{ route('profile.update') }}" method="POST" class="card-body">
        @csrf
        @method('PUT')
        <h2 class="mb-4">Infomasi Akun</h2>
        <div class="row align-items-center">
            <div class="col-auto"><span class="avatar avatar-xl"
                    style="background-image: url({{ Auth::user()->avatar ?? asset('assets/img/avatar.jpg') }})"></span>
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <div class="form-label required">Nama Lengkap</div>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ Auth::user()->name }}">
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-label required">Alamat Email</div>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ Auth::user()->email }}">
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">
                        <label class="form-label required" for="dob">Tanggal Lahir</label>
                        <input value="{{ date('d M Y', strtotime(old('dob') ?? Auth::user()->dob)) }}" type="text"
                            class="form-control" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="dob" class="form-label">Edit</label>
                        <input type="date" value="{{ old('dob') ?? Auth::user()->dob }}" name="dob"
                            id="dob" class="form-control @error('dob') is-invalid @enderror">
                    </div>
                </div>
                @error('dob')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label required" for="gender">Jenis Kelamin</label>
                <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                    <option value="0" selected="">-- Select Gender --</option>
                    @foreach ($gender as $i => $k)
                        <option {{ Auth::user()->gender == $k ? 'selected' : '' }} value={{ $k }}>
                            {{ $k }}</option>
                    @endforeach
                </select>
                @error('gender')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col">
                <div class="form-label">Alamat</div>
                <textarea class="form-control" name="address" id="address" cols="30" rows="5">{{ Auth::user()->address }}</textarea>
            </div>
            <h3 class="card-title my-4">Kelola Password</h3>
            <p class="card-subtitle text-info">Kamu tidak perlu mengisi bagian berikut jika hanya ingin mengupdate
                profil. Namun jika kamu ingin mengubah password akunmu, silahkan klik tombol berikut.</p>
            <div class="mb-5">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-change-password" class="btn">Set
                    Password baru</a>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>


    {{-- Modal Change Password --}}
    <div class="modal modal-blur fade" id="modal-change-password" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <form method="POST" action="{{ route('profile.update-password') }}" class="modal-content">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="modal-title">Update Password</div>
                    <small class="text-info">Pastikan kamu menyimpan informasi terkait akunmu pada catatan agar kamu
                        selalu terjaga dengan
                        itu.</small>
                    <div class="my-3">
                        <label class="form-label required" for="password">Password Baru</label>
                        <input type="password" name="password" id="password" placeholder="min: 8 digit"
                            class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mb-3">
                        <button type="button" class="btn btn-link link-secondary me-auto"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const btnChangePwd = document.querySelector('#btn-change-password')
    </script>
</x-setting-layout>
