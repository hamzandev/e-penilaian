<x-app-layout title="Kaitkan Guru ke Akun">
    <div class="row">
        <div class="col-md-5">
            <button onclick="redirectToPreviousPage()" class="btn btn-outline-danger mb-3"><svg
                    xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11 7l-5 5l5 5" />
                    <path d="M17 7l-5 5l5 5" />
                </svg>Back</button>
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Kaitkan data Guru ke Akun</span>
                </div>
                <form class="card-body" action="{{ route('manage-users.connect-account', $teacher->id) }}"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <p class="text-secondary">Kaitkan data Guru dengan akun yang telah terdaftar sebelumnya</p>
                    <div class="mb-3">
                        <span class="form-label">Guru yang akan dikaitkan</span>
                        <table cellpadding="5">
                            <tr>
                                <td>Nama </td>
                                <td>:</td>
                                <td>{{ $teacher->name }}</td>
                            </tr>
                            <tr>
                                <td>NUPTK </td>
                                <td>:</td>
                                <td><span class="badge bg-primary text-white">{{ $teacher->nuptk }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" name="email" id="email-hidden">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pilih Akun</label>
                        <div class="input-group mb-2">
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                <option value="0">-- Select user account --</option>
                                @foreach ($users as $user)
                                    <option value={{ $user->id }}>{{ $user->email }} - {{ $user->role }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success">Kaitkan</button>
                        </div>
                        @error('user_id')
                            <small class="text-red">{{ $message }}</small>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function redirectToPreviousPage() {
            window.history.back();
        }

        const emailHidden = document.querySelector('#email-hidden')
        const userId = document.querySelector('#user_id')

        userId.addEventListener('change', function(e) {
            // emailHidden.value = e.target.selected;
            const text = e.target.selectedOptions[0].text;
            email = text.split(' - ')[0]
            emailHidden.value = email;
            console.log(emailHidden.value)
        })
    </script>
</x-app-layout>
