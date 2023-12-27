<x-app-layout title="Detail Nilai Pemelajaran Mapel Siswa">
    <div class="col">
        @if (Session::has('message'))
            <x-alert type="success" message="{{ Session::get('message') }}" />
        @elseif(Session::has('error'))
            <x-alert type="error" message="{{ Session::get('error') }}" />
        @endif

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <h1>Data Pembelajaran</h1>
                        <a href="{{ route('studies.create') }}" class="btn btn-primary"><svg
                                xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                <path d="M9 12h6" />
                                <path d="M12 9v6" />
                            </svg>
                            Tambah Grade
                        </a>
                    </div>
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
                                        {{-- {{ $value->finalValue }} --}}
                                        <tr>
                                            <td>{{ $value->nisn }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>
                                                {{-- <input type="hidden" name="student_id{{ $value->id }}" value="{{ $value->id }}"> --}}
                                                <input type="number" name="knowledge{{ $value->id }}"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" name="ability{{ $value->id }}"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" name="pts{{ $value->id }}"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="number" name="pas{{ $value->id }}"
                                                    class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                {{ ($value->finalValue?->knowledge + $value->finalValue?->ability + $value->finalValue?->pas + $value->finalValue?->pts) / 4 ?? '-' }}
                                            </td>
                                            <td>
                                                <textarea name="description{{ $value->id }}" id="description" cols="40" rows="3" class="form-control"></textarea>
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
