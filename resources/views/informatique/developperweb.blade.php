@include('layouts.page')

<title>Développeur web | nearspot</title>

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
    <h3 class="text-center mb-4">Annonces pour Développeur Web</h3>

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
                                            <p class="card-text"><strong>Adresse:</strong> {{ $annonce->adresse }}</p>
                                        </div>
                                    </div>
                                </div>
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
function initMap() {
    // Initialise la carte centrée par défaut
    var map = L.map('map-overview').setView([48.8566, 2.3522], 6); // Exemple : centre de la carte sur la France

    // Ajouter la couche de tuiles OpenStreetMap
    L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
        maxZoom: 18,
        attribution: '© nearspot 2024'
    }).addTo(map);

    return map;
}

function addMarkerToMap(map, adresse, title) {
    var encodedAddress = encodeURIComponent(adresse);
    var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodedAddress}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                var lat = data[0].lat;
                var lon = data[0].lon;

                // Ajouter un marqueur pour chaque annonce
                L.marker([lat, lon]).addTo(map)
                    .bindPopup(`<b>${title}</b><br>${adresse}`)
                    .openPopup();
            } else {
                console.error("Aucune donnée trouvée pour l'adresse :", adresse);
            }
        })
        .catch(error => console.error("Erreur lors de l'accès à l'API de géocodage :", error));
}

document.addEventListener('DOMContentLoaded', function () {
    // Initialiser la carte une seule fois
    var map = initMap();

    // Ajouter un marqueur pour chaque annonce
    @foreach($annonces as $annonce)
        addMarkerToMap(map, "{{ $annonce->adresse }}", "{{ $annonce->intitule }}");
    @endforeach
});
</script>
