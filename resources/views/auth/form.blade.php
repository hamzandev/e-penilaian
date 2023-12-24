<x-app-layout title="Home">
    <div class="row">
        <form method="POST" action="{{ route('login.process') }}" class="col-md-5 mx-auto">
            @if (Session::has('message'))
                <x-alert type="success" message="{{ Session::get('message') }}" />
            @elseif(Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}" />
            @endif

            @csrf
            <fieldset class="form-fieldset p-5 mt-4 shadow-lg" style="border-radius: 12px;">
                <div class="m-md-3">
                    <h1 class="text-center">Welcome, Admin!</h1>
                    <p class="text-secondary text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis
                        doloribus
                        dolorum quisquam!</p>
                    {{-- <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-at"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" />
                            </svg>
                        </span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control @error('email') 'is-invalid'  @enderror" placeholder="Email Address">
                    </div> --}}
                    {{-- <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                                <path d="M15 9h.01" />
                            </svg>
                        </span>
                        <input type="password" name="password" id="password" class="form-control @error('password') 'is-invalid'  @enderror">
                        @error('password')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" value="{{ old('email') }}" placeholder="john@doe.com">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" value="{{ old('password') }}">
                        @error('password')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
</x-app-layout>
