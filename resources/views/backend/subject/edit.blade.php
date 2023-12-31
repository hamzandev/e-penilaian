<x-app-layout title="Edit Mata Pelajaran">
    <div class="row">
        <div class="col-md-6">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif
            <form method="POST" action="{{ route('master-data.subject.update', $subject->id) }}" class="card shadow">
                @csrf
                @method('PUT')
                <div class="card-header d-flex align-items-baseline justify-content-between">
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
                    <h2>Edit Mata Pelajaran</h2>
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
                                        name="name" id="name" value="{{ old('name') ?? $subject->name }}"
                                        placeholder="ex: XI">
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
                                            <option {{ old('teacher_id') ?? $subject->teacher_id == $t->id ? 'selected' : '' }} value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required" for="standard">KKM (standard)</label>
                                    <input type="text" class="form-control @error('standard') is-invalid @enderror"
                                        name="standard" id="standard" value="{{ old('standard') ?? $subject->standard }}"
                                        placeholder="ex: XI">
                                    @error('standard')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="description">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="4"
                                        placeholder="Deskripsi Mata Pelajaran">{{ old('description') ?? $subject->description }}</textarea>
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
