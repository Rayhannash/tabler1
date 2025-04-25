<x-app-layout pageTitle="Daftar Akun Baru">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container container-normal">
            <div class="row align-items-center g-4">
                <!-- Form Pendaftaran -->
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="110" height="32" viewBox="0 0 232 68" class="navbar-brand-image">
                                    <!-- SVG Logo Content -->
                                    <path d="..." fill="#066fd1" style="fill: var(--tblr-primary, #066fd1)" />
                                    <path d="..." fill-rule="evenodd" clip-rule="evenodd" fill="#4a4a4a" />
                                </svg>
                            </a>
                        </div>

                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h3 text-center mb-4">Buat Akun</h2>

                                <form action="{{ route('auth.register') }}" method="POST" onsubmit="showLoader(event)">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}" required>
                                        @error('fullname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required id="password" autocomplete="off">
                                            <span class="input-group-text">
                                                <a href="#" class="input-group-link" id="toggle-password">
                                                    <span class="mdi mdi-eye-outline"></span>
                                                </a>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" name="password_confirmation" class="form-control" required id="password_confirmation" autocomplete="off">
                                            <span class="input-group-text">
                                                <a href="#" class="input-group-link" id="toggle-password-confirmation">
                                                    <span class="mdi mdi-eye-outline"></span>
                                                </a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100" id="loginBtn">Daftar</button>
                                    </div>

                                    <x-page-loader message="" sizeProgressBar="md" />
                                </form>
                            </div>
                        </div>

                        <div class="text-center text-secondary mt-3">
                            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                        </div>
                    </div>
                </div>

                <!-- Ilustrasi -->
                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('static/illustrations/light/computer-fix.png') }}" alt="Illustration" class="img d-block mx-auto" height="400">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showLoader(event) {
                event.preventDefault();
                document.getElementById('loginBtn').disabled = true;
                showLoading();
                setTimeout(() => event.target.submit(), 2000);
            }

            // Toggle password visibility for password input
            document.getElementById('toggle-password').addEventListener('click', function (e) {
                e.preventDefault();
                const passwordField = document.getElementById('password');
                const passwordIcon = this.querySelector('span');
                const isHidden = passwordField.type === 'password';

                passwordField.type = isHidden ? 'text' : 'password';
                passwordIcon.classList.toggle('mdi-eye-outline');
                passwordIcon.classList.toggle('mdi-eye-off');
            });

            // Toggle password visibility for confirmation input
            document.getElementById('toggle-password-confirmation').addEventListener('click', function (e) {
                e.preventDefault();
                const confirmationField = document.getElementById('password_confirmation');
                const confirmationIcon = this.querySelector('span');
                const isHidden = confirmationField.type === 'password';

                confirmationField.type = isHidden ? 'text' : 'password';
                confirmationIcon.classList.toggle('mdi-eye-outline');
                confirmationIcon.classList.toggle('mdi-eye-off');
            });
        </script>
    @endpush
</x-app-layout>
