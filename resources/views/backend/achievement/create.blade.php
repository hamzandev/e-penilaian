<x-app-layout title="Tambah Siswa Berprestasi">
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
                    <h2>Tambah Siswa Berprestasi</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="student_id">Siswa</label>
                                    <select class="form-select @error('student_id') is-invalid @enderror" name="student_id"
                                        id="student_id">
                                        <option value="0" selected="">-- Select Student --</option>
                                        @foreach ($student as $i => $k)
                                            <option {{ $k->id == old('student_id') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label" for="type">Type</label>
                                    <select class="form-select @error('type') is-invalid @enderror" name="typr"
                                        id="gender">
                                        <option value="0" selected="">-- Select Type --</option>
                                        @foreach ($type as $i => $k)
                                            <option {{ $k->id == old('type') ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->akademik }} ({{ $k->non_akademik }})</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
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