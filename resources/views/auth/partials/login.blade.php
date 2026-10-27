<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="text-center mb-1">Login {{ $role }}</h4>
                    <p class="text-center text-muted small mb-4">Masuk ke akun {{ $role }} kamu</p>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ $action }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}"
                                   class="form-control @error('username') is-invalid @enderror" required autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-{{ $color }} w-100">Login</button>
                    </form>

                    @isset($registerUrl)
                        <p class="text-center small mt-3 mb-0">
                            Belum punya akun? <a href="{{ $registerUrl }}">Daftar</a>
                        </p>
                    @endisset

                    <p class="text-center small mt-2 mb-0">
                        <a href="{{ url('/') }}">&larr; Kembali</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
