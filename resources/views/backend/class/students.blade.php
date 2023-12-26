<x-app-layout title="Anggota Kelas">
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
                        <h1>Anggota Kelas <span class="badge bg-success text-white">{{ $studentsOfClass->name }}</span>
                        </h1>
                        <div class="d-flex gap-2">
                            <a href="{{ route('master-data.class.students.add', $studentsOfClass->id) }}"
                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M9 12h6" />
                                    <path d="M12 9v6" />
                                </svg>Tambah Siswa ke Kelas
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Gender</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentsOfClass->student as $i => $k)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $k->name }}</td>
                                        <td>{{ $k->nisn }}</td>
                                        <td>{{ $k->gender }}</td>
                                        <td>{{ date('d M Y', strtotime($k->dob)) }}</td>
                                        <td>{{ $k->address }}</td>
                                        <td>
                                            <form style="d-inline" method="POST"
                                                action="{{ route('master-data.class.students.remove', [
                                                    'kelasId' => $studentsOfClass->id,
                                                    'studentId' => $k->id,
                                                ]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Anda yakin ingin menghapus siswa ini dari Kelas?')"
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

</x-app-layout>
