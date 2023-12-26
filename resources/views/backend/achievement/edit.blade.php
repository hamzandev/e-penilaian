<x-app-layout title="Edit Siswa Berprstasi">
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif
            <form method="POST" action="{{ route('master-data.academics.update', $academics->id) }}" class="card">
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
                    <h2>Edit Siswa Berprestasi : <span class="badge bg-info text-white">{{ $student->nisn }}</span></h2>
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
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="akademik_id">Akademik</label>
                                    <select class="form-select @error('akademik_id') is-invalid @enderror" name="akademik_id"
                                        id="akademik_id">
                                        <option value="0" selected="">-- Select Akademik --</option>
                                        @foreach ($akademik as $i => $k)
                                            <option {{ $student->akademik_id == $k->id ? 'selected' : '' }}
                                                value={{ $k->id }}>{{ $k->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('akademik_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="non-akademik">Non Akademik</label>
                                    <select class="form-select @error('non-akademik') is-invalid @enderror" name="non-akademik"
                                        id="gender">
                                        <option value="0" selected="">-- Select Non Akademik --</option>
                                        @foreach ($nonakademik as $i => $k)
                                            <option {{ $student->nonakademik == $k ? 'selected' : '' }}
                                                value={{ $k }}>{{ $k }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>