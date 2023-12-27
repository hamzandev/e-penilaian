<x-app-layout title="Detail Nilai Pemelajaran Mapel Siswa">
    <div class="col">
        @if (Session::has('message'))
            <x-alert type="success" message="{{ Session::get('message') }}" />
        @elseif(Session::has('error'))
            <x-alert type="error" message="{{ Session::get('error') }}" />
        @endif

        <div class="row">
            <div class="col mb-3">
                <a href="#" class="btn btn-outline-danger">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <div class="alert alert-info bg shadow alert-lg">
                    <table cellpadding="5">
                        <tr>
                            <td>
                                <h2>Mata Pelajaran</h2>
                            </td>
                            <td>
                                <h2> : </h2>
                            </td>
                            <td>
                                <h2>{{ $data->name }}</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-secondary">Kelas</span>
                            </td>
                            <td>
                                <span class="text-secondary"> : </span>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $data->teacher->kelas->kelasLevel->level }} - {{ $data->teacher->kelas->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-secondary">KKM (Standard)</span>
                            </td>
                            <td>
                                <span class="text-secondary"> : </span>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $data->standard }} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-secondary">Guru Pengampu</span>
                            </td>
                            <td>
                                <span class="text-secondary"> : </span>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $data->teacher->name }} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-secondary">Tahun Ajaran</span>
                            </td>
                            <td>
                                <span class="text-secondary"> : </span>
                            </td>
                            <td>
                                <span class="text-secondary text-uppercase">{{ $data->teacher->kelas->schoolyear->start_year }}/{{ $data->teacher->kelas->schoolyear->start_year }} ({{ $data->teacher->kelas->schoolyear->semester_type }}) </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <form action="{{ route('studies.store', $data->id) }}" method="POST" class="card-body">
                        @csrf
                        <div class="table-responsive">
                            <table id="datatable" class="table card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Pengetahuan</th>
                                        <th>Keterampilan</th>
                                        <th>Nilai PTS</th>
                                        <th>Nilai PAS</th>
                                        <th>Rata-Rata</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->teacher->kelas->student as $i => $value)
                                        {{-- {{ $value->finalValue->description }} --}}
                                        <tr>
                                            <td>{{ $value->nisn }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>
                                                <input type="hidden" value="{{ $value->id }}"
                                                    name="student_id[{{ $i }}]">
                                                <input type="number"
                                                    value="{{ old('knowledge.' . $value->id) ?? $value->finalValue->knowledge }}"
                                                    name="knowledge[{{ $i }}]"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number"
                                                    value={{ old('ability.' . $value->id) ?? $value->finalValue->ability }}
                                                    name="ability[{{ $i }}]"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number"
                                                    value="{{ old('pts.' . $value->id) ?? $value->finalValue->pts }}"
                                                    name="pts[{{ $i }}]"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number"
                                                    value="{{ old('pas.' . $value->id) ?? $value->finalValue->pas }}"
                                                    name="pas[{{ $i }}]"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                {{ $value->finalValue->average ?? '0' }}
                                            </td>
                                            <td>
                                                <textarea name="description[{{ $i }}]" id="description" cols="40" rows="3" class="form-control">{{ old('description.' . $value->id) ?? $value->finalValue->description }}</textarea>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="my-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
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
        </div>
    </div>
</x-app-layout>
