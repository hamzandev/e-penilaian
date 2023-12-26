<x-app-layout title="Edit Siswa">
    <div class="row">
        <div class="col-md-9">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif
            <form method="POST" action="{{ route('master-data.student.update', $student->id) }}" class="card">
                @csrf
                @method('PUT')
                <div class="card-header d-flex align-items-center justify-content-between">
                    <a href="{{ route('master-data.student.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Edit Siswa : <span class="badge bg-info text-white">{{ $student->nisn }}</span></h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') ?? $student->name }}"
                                        placeholder="John Doe">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="nisn">NISN</label>
                                    <input type="number" class="form-control @error('nisn') is-invalid @enderror"
                                        name="nisn" value="{{ old('nisn') ?? $student->nisn }}" id="nisn"
                                        placeholder="ex: 9283128312 (10 digit)">
                                    @error('nisn')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="kelas_id">Kelas</label>
                                    <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id"
                                        id="kelas_id">
                                        <option value="0" selected="">-- Select Kelas --</option>
                                        @foreach ($kelas as $i => $k)
                                            <option {{ $student->kelas_id == $k->id ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="gender">Jenis Kelamin</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                        id="gender">
                                        <option value="0" selected="">-- Select Gender --</option>
                                        @foreach ($gender as $i => $k)
                                            <option {{ $student->gender == $k ? 'selected' : '' }}
                                                value={{ $k }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-end">
                                    <div class="col-md-7">
                                        <div class="mb-2">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input value="{{ date('d M Y', strtotime($student->dob)) }}"
                                                type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-5">
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
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Alamat</label>
                                    <textarea class="form-control" name="address" id="address" rows="3">{{ old('address') ?? $student->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success ms-auto">
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
    </div>
</x-app-layout>
