@include ('layouts.page')
<title>Nearspot | Login </title>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <h3 class="text-center mb-4">Connexion</h3>

        <!-- Status Session Message -->
        @if (session('status'))
            <div class="alert alert-success mb-4 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">{{ __('Se souvenir de moi') }}</label>
            </div>

            <!-- Links and Submit Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-underline text-muted small">{{ __('Mot de passe oublié?') }}</a>
                @endif
                <a href="{{ route('register') }}" class="text-decoration-underline text-muted small">{{ __("S'inscrire?") }}</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Connexion') }}
            </button>
        </form>
    </div>
</div>
