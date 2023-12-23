<x-app-layout title="Tambah Grade Baru">
    <div class="row">
        <div class="col-md-10">
            @if (Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif
            <form method="POST" action="{{ route('academics.grade.store') }}" class="card">
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between">
                    <a href="{{ route('academics.grade.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Tambah Grade Baru</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="kelas_id">Kelas</label>
                                    <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id"
                                        id="kelas_id">
                                        <option value="0" selected="">-- Select Kelas --</option>
                                        @foreach ($kelas as $i => $k)
                                            <option {{ $k->id == old('kelas_id') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label" for="gender">Siswa</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                        id="gender">
                                        <option value="0" selected="">-- Select Student --</option>
                                        @foreach ($student as $i => $k)
                                            <option {{ $k->id == old('gender') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }} ({{ $k->nisn }})</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label" for="gender">Guru</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                        id="gender">
                                        <option value="0" selected="">-- Select Teacher --</option>
                                        @foreach ($teacher as $i => $k)
                                            <option {{ $k->id == old('gender') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="dob">Tanggal Lahir</label>
                                    <input value="{{ old('dob') }}" type="date" name="dob" id="dob"
                                        class="form-control @error('dob') is-invalid @enderror">
                                    @error('dob')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="weight">Bobot</label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                        name="weight" id="weight" value="{{ old('weight') }}"
                                        placeholder="ex: 2">
                                    @error('weight')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="value">Nilai</label>
                                    <input type="number" class="form-control @error('value') is-invalid @enderror"
                                        name="value" value="{{ old('value') }}" id="value"
                                        placeholder="ex: 89 (nilai siswa)">
                                    @error('value')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Alamat</label>
                                    <textarea class="form-control" name="address" id="address" rows="3">{{ old('address') }}</textarea>
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
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
