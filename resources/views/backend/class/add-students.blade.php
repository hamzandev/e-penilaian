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
                <div class="mb-3">
                    <a href="{{ route('master-data.class.index') }}" class="btn btn-outline-danger">
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
                    <div class="card-header d-grid">
                        <h1>Tambah Anggota Kelas</h1>
                        <span class="text-secondary">Berikut adalah data siswa yang belum memiliki kelas</span>
                        <div class="alert alert-info mt-3">
                            INFO : Pastikan kamu klik "Show All entries" sebelum kamu memilih
                            semua siswa
                        </div>
                    </div>
                    <form action="{{ route('master-data.class.students.add-action', $id) }}" method="POST"
                        class="card-body">
                        @csrf
                        @method('PATCH')
                        <table id="datatable" class="table card-table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="form-check-input" id="checkAll"></th>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Gender</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentsNoClass as $i => $k)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input" value="{{ $k->id }}"
                                                name="student_{{ $k->id }}" id="{{ $k->id }}">
                                        </td>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $k->name }}</td>
                                        <td>{{ $k->nisn }}</td>
                                        <td>{{ $k->gender }}</td>
                                        <td>{{ date('d M Y', strtotime($k->dob)) }}</td>
                                        <td>{{ $k->address }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="my-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // const checkedInput = [];
        const checkAll = document.querySelector('#checkAll')
        const allCheckbox = document.querySelectorAll('input[type="checkbox"]');
        checkAll.addEventListener('input', () => {
            allCheckbox.forEach((element, i) => {
                if (element.checked == false) {
                    checkAll.checked = true
                    element.checked = true
                    element.name = `student_${i}`;
                } else {
                    checkAll.checked = false
                    element.checked = false
                    element.removeAttribute('name')
                }
                // console.log(element);
            });
        })
    </script>

</x-app-layout>
