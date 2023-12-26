<x-app-layout title="My Class">
    <div class="row">
        <div class="col-md-9">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif

            @error('file_excel')
                <x-alert type="error" message="{{ $message }}" />
            @enderror

            <div class="row">
                <div class="col">
                    {{-- {{ json_encode($myClasses) }} --}}
                    <div class="card">
                        <div class="card-header d-md-flex d-grid justify-content-md-between align-items-baseline">
                            <h2>Daftar Kelas Saya
                            </h2>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tingkat Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($myClasses as $i => $k)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $k->name }}</td>
                                            <td>{{ $k->kelasLevel->level }}</td>
                                            <td>{{ $k->schoolyear->start_year }}/{{ $k->schoolyear->end_year }}
                                            ({{ $k->schoolyear->semester_type }})</td>
                                            <td>
                                                <a href="{{ route('wali-kelas.students', [$k->id, $k->teacher->id]) }}" class="badge text-white bg-orange">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
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
    </div>
</x-app-layout>
