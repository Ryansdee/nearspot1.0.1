<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://i.ibb.co/cCcJkHS/nearsport.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>
<style>
    .map-container {
    height: 200px;
}
</style>
<body class="bg-light">
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
                    <!-- Dropdown Menu pour l'utilisateur connecté -->
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/travail/create') }}">Proposer</a></li>
                        </ul>
                    </div>
                @else
                    <!-- Bouton de Connexion pour les utilisateurs non connectés -->
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
                @endauth
            @endif
        </div>
        </div>
    </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>