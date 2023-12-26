<x-app-layout title="Anggota Kelas">
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('wali-kelas.my-classes') }}" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11 7l-5 5l5 5" />
                    <path d="M17 7l-5 5l5 5" />
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3>Informasi Kelas</h3>
                        </div>
                        <div class="card-footer">
                            <table cellpadding="5">
                                <tr>
                                    <td>Nama Kelas</td>
                                    <td>:</td>
                                    <td>{{ $studentsOfClass->name }}</td>
                                </tr>
                                <tr>
                                    <td>Tingkat Kelas</td>
                                    <td>:</td>
                                    <td>Kelas {{ $studentsOfClass->kelasLevel->level }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun Ajaran</td>
                                    <td>:</td>
                                    <td>{{ $studentsOfClass->schoolyear->start_year }}/{{ $studentsOfClass->schoolyear->end_year }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Semester</td>
                                    <td>:</td>
                                    <td>{{ $studentsOfClass->schoolyear->semester_type }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3>Informasi Wali Kelas</h3>
                        </div>
                        <div class="card-footer">
                            <table cellpadding="5">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $studentsOfClass->teacher->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td>{{ now()->diffInYears($studentsOfClass->teacher->dob) }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>:</td>
                                    <td>{{ $studentsOfClass->teacher->gender }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $studentsOfClass->teacher->address ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="card">
                        <div class="card-header d-md-flex d-grid justify-content-md-between align-items-baseline">
                            <h2>Daftar Siswa Kelas
                                <span class="badge bg-success text-white">
                                    {{ $studentsOfClass->kelasLevel->level }} -
                                    {{ $studentsOfClass->name }}
                                </span>
                            </h2>
                            @if (auth()->user()->role == 'admin')
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
                            @else
                                <p class="text-info">Silahkan hubungi Admin untuk menambahkan data Siswa</p>
                            @endif
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
                                                @if (auth()->user()->role == 'admin')
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
                                                                class="icon icon-tabler icon-tabler-trash"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path
                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    @else
                                                    <a href="#" class="badge bg-orange text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3.5 5.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 11.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 17.5l1.5 1.5l2.5 -2.5" /><path d="M11 6l9 0" /><path d="M11 12l9 0" /><path d="M11 18l9 0" /></svg>
                                                    </a>
                                                @endif
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
