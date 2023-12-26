<x-app-layout title="Tambah Grade Baru">
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif
            <form method="POST" action="{{ route('academics.grades.store') }}" class="card">
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between">
                    <a href="{{ route('academics.grades.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Tambah Pembelajaran</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        {{-- <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="subject_id">Mapel</label>
                                    <select class="form-select @error('subject_id') is-invalid @enderror" name="subject_id"
                                        id="subject_id">
                                        <option value="0" selected="">-- Select Mapel --</option>
                                        @foreach ($subject as $i => $k)
                                            <option {{ $k->id == old('subject_id') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label" for="student_id">Siswa</label>
                                    <select class="form-select @error('student_id') is-invalid @enderror" name="student_id"
                                        id="student_id">
                                        <option value="0" selected="">-- Select Student --</option>
                                        @foreach ($student as $i => $k)
                                            <option {{ $k->id == old('student_id') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }} ({{ $k->nisn }})</option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="teacher_id">Guru Mapel</label>
                                    <select class="form-select @error('teacher_id') is-invalid @enderror" name="teacher_id"
                                        id="teacher_id">
                                        <option value="0" selected="">-- Select Teacher --</option>
                                        @foreach ($teacher as $i => $k)
                                            <option {{ $k->id == old('teacher_id') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="weight">Bobot</label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                        name="weight" id="weight" value="{{ old('weight') }}"
                                        placeholder="Bobot nilai Mapel">
                                    @error('weight')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="value">Nilai</label>
                                    <input type="number" class="form-control @error('value') is-invalid @enderror"
                                        name="value" value="{{ old('value') }}" id="value"
                                        placeholder="Nilai mapel Siswa">
                                    @error('value')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
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
