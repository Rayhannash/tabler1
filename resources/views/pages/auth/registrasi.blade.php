<x-app-layout pageTitle="Registrasi">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container container-normal">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark">
                                <img src="{{ asset('logo.png') }}" height="36" alt="">
                            </a>
                        </div>

                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h4 text-center mb-4">Registrasi</h2>

                                <form action="{{ route('auth.register') }}" method="POST">
                                    @csrf

                                    <!-- Nama Lengkap -->
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="fullname" class="form-control" required autofocus value="{{ old('fullname') }}">
                                    </div>

                                    <!-- Username -->
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" required value="{{ old('username') }}">
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <!-- Konfirmasi Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>

                                    <!-- Role (Dropdown) -->
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select name="role_id" class="form-control" required>
                                            <option value="1">Super Admin</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="text-center text-muted mt-3">
                            Sudah punya akun? <a href="{{ route('login') }}" tabindex="-1">Login</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
