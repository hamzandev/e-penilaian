<x-app-layout title="Siswa">
    <div class="col-md-10">
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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <h1>Siswa</h1>
                        <div class="d-flex gap-2">
                            <a href="{{ route('master-data.student.create') }}" class="btn btn-primary"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M9 12h6" />
                                    <path d="M12 9v6" />
                                </svg>Tambah Siswa
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="#modal-small" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-file-spreadsheet" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M8 11h8v7h-8z" />
                                    <path d="M8 15h8" />
                                    <path d="M11 11v7" />
                                </svg>
                                Import Siswa
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Gender</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $i => $k)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $k->name }}</td>
                                        <td>{{ $k->nisn }}</td>
                                        <td>
                                            @if ($k->kelas)
                                                {{ $k->kelas->name }}
                                            @else
                                                <i class="text-secondary">Belum ditetapkan</i>
                                            @endif
                                        </td>
                                        <td>{{ $k->gender }}</td>
                                        <td>{{ date('d M Y', strtotime($k->dob)) }}</td>
                                        <td>{{ $k->address }}</td>
                                        <td>
                                            <a href="{{ route('master-data.student.edit', $k->id) }}"
                                                class="badge bg-primary text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-edit" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                            </a>
                                            <form style="d-inline" method="POST"
                                                action="{{ route('master-data.student.destroy', $k->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Data ini akan dihapus permanen. Yakin Hapus?')"
                                                    type="submit" class="badge bg-danger text-white">
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
                                                </button>
                                            </form>
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


    {{-- modal import data --}}
    <div class="modal modal-blur fade" id="modal-small" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" enctype="multipart/form-data" action="{{ route('master-data.student.import') }}"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h3>Import Data Siswa dengan file Excel</h3>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="my-3">
                            <label for="file_excel" class="form-label">Upload File Excel</label>
                            <input type="file" name="file_excel" id="file_excel" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 9l5 -5l5 5" />
                            <path d="M12 4l0 12" />
                        </svg>
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
