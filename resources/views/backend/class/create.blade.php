<x-app-layout title="Tambah Kelas Baru">
    <div class="row">
        <div class="col-md-6">
            @if (Session::has('info'))
                <x-alert type="info" message="{{ Session::get('info') }}" />
            @endif
            <form method="POST" action="{{ route('master-data.class.store') }}" class="card shadow">
                @csrf
                <div class="card-header d-flex align-items-baseline justify-content-between">
                    <a href="{{ route('master-data.class.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Tambah Kelas Baru</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Nama Kelas</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') }}" placeholder="ex: MIPA 2">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="kelas_level_id">Level Kelas</label>
                                    <select class="form-control @error('kelas_level_id') is-invalid @enderror"
                                        name="kelas_level_id" id="kelas_level_id" placeholder="ex: XI">
                                        <option value="0">-- Select Level Kelas --</option>
                                        @foreach ($kelasLevel as $kl)
                                            <option {{ old('kelas_level_id') == $kl->id ? 'selected' : '' }}
                                                value="{{ $kl->id }}">{{ $kl->level }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas_level_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="schoolyear_id">Tahun Ajaran</label>
                                    <select class="form-control @error('schoolyear_id') is-invalid @enderror"
                                        name="schoolyear_id" id="schoolyear_id" placeholder="ex: XI">
                                        <option value="0">-- Select School year --</option>
                                        @foreach ($schoolyear as $kl)
                                            <option {{ old('schoolyear_id') == $kl->id ? 'selected' : '' }}
                                                value="{{ $kl->id }}">{{ $kl->start_year }}/{{ $kl->end_year }}
                                                ({{ $kl->semester_type }})</option>
                                        @endforeach
                                    </select>
                                    @error('schoolyear_id')
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
