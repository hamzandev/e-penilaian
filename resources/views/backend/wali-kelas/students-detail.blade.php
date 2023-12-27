<x-app-layout title="Data Pembelajaran">
    <div class="col">
        @if (Session::has('message'))
            <x-alert type="success" message="{{ Session::get('message') }}" />
        @elseif(Session::has('error'))
            <x-alert type="error" message="{{ Session::get('error') }}" />
        @endif

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <a href="{{ route('wali-kelas.students', [$data->kelas->teacher->id, auth()->user()->id, $data->id]) }}"
                        class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M11 7l-5 5l5 5" />
                            <path d="M17 7l-5 5l5 5" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <h1>Data Pembelajaran Siswa <span class="badge bg-success text-white">{{ $data->nisn }}</span>
                        </h1>
                    </div>
                    <form
                        action="{{ route('wali-kelas.students.detail-action', [$data->kelas->id, auth()->user()->id, $data->id]) }}"
                        method="POST" class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="table-responsive">
                            <table id="datatable" class="table card-table table-striped">
                                <thead class="thead-primary">
                                    <tr>
                                        <th rowspan="2">Aksi</th>
                                        <th rowspan="2">Nama Siswa</th>
                                        <th rowspan="2">NISN</th>
                                        <th rowspan="2">L/P</th>
                                        <th colspan="10" class="text-center">Nilai</th>
                                    </tr>
                                    <tr>
                                        @foreach ($subjects as $s)
                                            <th>{{ $s->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#" class="badge bg-red text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->nisn }}</td>
                                        <td>{{ $data->gender }}</td>
                                        @foreach ($subjects as $i => $s)
                                            <td>
                                                <input type="number" name="{{ $s->id }}"
                                                    value="{{ $values[$i]->value ?? '' }}"
                                                    class="form-control form-control-sm">
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="my-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        {{-- {{ $s->grade }} --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
