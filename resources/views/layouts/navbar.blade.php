@section('navbar')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="https://i.ibb.co/cCcJkHS/nearsport.png" alt="Logo" class="d-inline-block align-text-top" width="30">
            NearSpot
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Home link -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/home">Accueil</a>
                </li>
            </ul>
            <!-- Search bar -->
            <form class="d-flex me-3" role="search" action="{{ route('search') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Dév.." name="search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Chercher</button>
            </form>

            <!-- User Authentication links -->
            <div class="d-flex">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/profile') }}" class="btn btn-outline-dark me-2">{{ Auth::user()->name}}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>
@stop