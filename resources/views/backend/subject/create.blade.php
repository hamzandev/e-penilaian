<x-app-layout title="Tambah Mata Pelajaran Baru">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ route('master-data.subject.store') }}" class="card shadow">
                @csrf
                <div
                    class="card-header d-flex flex-md-row flex-column gap-md-0 gap-3 align-items-baseline justify-content-between">
                    <a href="{{ route('master-data.subject.index') }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                    <h2>Tambah Mata Pelajaran Baru</h2>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <span class="text-info">Tanda <span class="text-danger">(*)</span> Menyatakan field
                                        wajib diisi.</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required" for="name">Mata Pelajaran</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required" for="teacher_id">Guru Pengampu</label>
                                    <select name="teacher_id" id="teacher_id" value="{{ old('teacher_id') }}"
                                        class="form-control @error('teacher_id') is-invalid @enderror">
                                        <option value="0">-- Select Teacher --</option>
                                        @foreach ($teachers as $key => $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="description">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="4"
                                        placeholder="Deskripsi Mata Pelajaran"></textarea>
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
