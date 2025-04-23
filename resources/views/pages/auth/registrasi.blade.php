<x-app-layout pageTitle="Daftar Akun Baru">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container container-normal">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
                                <img src="/logo.svg" height="32" alt="Logo" />
                            </a>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <h2 class="h3 text-center mb-4">Buat Akun</h2>

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
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Daftar</button>
                            </div>

                            <div class="text-center text-muted mt-3">
                                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="/assets/images/register-illustration.svg" alt="Register illustration" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
