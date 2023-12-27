<x-app-layout title="Data Pembelajaran">
    <div class="col-md-10">
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
                    <div class="card-body">
                        <table id="datatable" class="table card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Mapel</th>
                                    <th>Kelas</th>
                                    <th>Guru Mapel / Guru Pengampu</th>
                                    <th>Standard Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studies as $i => $value)
                                    {{ $value }}
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->teacher->kelas->kelasLevel->level }} -
                                            {{ $value->teacher->kelas->name }}</td>
                                        <td>{{ $value->teacher->name }}</td>
                                        <td>{{ $value->standard ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('studies.show', $value->id) }}"
                                                class="badge bg-orange text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-list-letters" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M11 6h9" />
                                                    <path d="M11 12h9" />
                                                    <path d="M11 18h9" />
                                                    <path d="M4 10v-4.5a1.5 1.5 0 0 1 3 0v4.5" />
                                                    <path d="M4 8h3" />
                                                    <path
                                                        d="M4 20h1.5a1.5 1.5 0 0 0 0 -3h-1.5h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
