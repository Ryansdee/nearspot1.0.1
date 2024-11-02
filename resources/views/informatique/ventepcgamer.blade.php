@include('layouts.page')

<title>Vente pc gamer | nearspot</title>

<style>
    .annonces-container {
        max-height: 400px; /* Hauteur fixe pour le défilement */
        overflow-y: auto;  /* Activer le défilement vertical */
    }

    .map-container {
        height: 400px; /* Hauteur de la carte */
    }
</style>

<div class="container mt-5">
    <h3 class="text-center mb-4">Annonces pour des ventes de pc gamer</h3>

    @if($annonces->isEmpty())
        <p class="text-center">Aucune annonce trouvée.</p>
    @else
        <div class="row">
            <div class="col-md-8"> <!-- Colonne pour les annonces -->
                <div class="card h-100" style="width: 500px; background: transparent; border: none;"> <!-- Card Bootstrap pour les annonces -->
                    <div class="card-body annonces-container"> <!-- Conteneur défilable -->
                        <div class="row justify-content-center">
                            @foreach($annonces as $annonce)
                                <div class="col-md-6 mb-4"> <!-- Utilisation de Bootstrap pour la mise en page -->
                                    <div class="card h-100 w-100"> <!-- Card Bootstrap -->
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $annonce->intitule }}</h5>
                                            <p class="card-text"><strong>Secteur:</strong> {{ $annonce->secteur }}</p>
                                            <p class="card-text"><strong>Description:</strong> {{ $annonce->description }}</p>

                                            @php
                                                // Récupère l'adresse complète
                                                $adresseComplet = $annonce->adresse;

                                                // Divise l'adresse par la virgule et prend la première partie
                                                $partiesAdresse = explode(',', $adresseComplet);
                                                $nomRue = trim($partiesAdresse[0]); // Prend le nom de la rue et enlève les espaces inutiles

                                                // Enlève le numéro de rue en utilisant une expression régulière
                                                $nomRue = preg_replace('/\d+/', '', $nomRue);
                                                // Enlève les espaces superflus en début et fin de chaîne
                                                $nomRue = trim($nomRue);
                                            @endphp

                                            <p class="card-text"><strong>Adresse:</strong> {{ $adresseComplet }}</p>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    // Récupère les informations nécessaires pour la carte
                                    $adresseComplet = $annonce->adresse;
                                    $intitule = $annonce->intitule;
                                @endphp
                            @endforeach
                        </div>
                    </div> <!-- Fin du conteneur défilable -->
                </div>
            </div>

            <div class="col-md-4"> <!-- Colonne pour la carte -->
                <div class="card h-100" style="margin-left: -350px !important; width: 800px;"> <!-- Card pour la carte -->
                    <div class="card-body">
                        <div id="map-overview" class="map-container" style="height: 400px; width: 770px; border-radius: 0.2rem;"></div> <!-- Conteneur pour la carte -->
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
function initMapForAddress(adresse, title) {
        // Ajout d'un contexte géographique (ex: Paris, France)
        var encodedAddress = encodeURIComponent(adresse);
        var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodedAddress}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Data from Nominatim:", data); // Pour vérifier les données dans la console
                if (data.length > 0) {
                    var lat = data[0].lat;
                    var lon = data[0].lon;

                    // Initialise la carte
                    var map = L.map('map-overview').setView([lat, lon], 13); // Utilise l'ID de la carte

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(`<b>${title}</b><br>${adresse}`) // Ajout de l'intitulé
                        .openPopup();
                } else {
                    console.error("Aucune donnée trouvée pour l'adresse :", adresse);
                }
            })
            .catch(error => console.error("Erreur lors de l'accès à l'API de géocodage :", error));
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Initialisation de la carte avec une adresse fixe (par exemple, pour la première annonce)
        @if($annonces->isNotEmpty())
            const firstAdresse = "{{ $annonces->first()->adresse }}";
            const firstIntitule = "{{ $annonces->first()->intitule }}"; // Récupération de l'intitulé de la première annonce
            initMapForAddress(firstAdresse, firstIntitule);
        @endif
    });
</script>
