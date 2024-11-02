@include('layouts.page')

<div class="container mt-5">
    <div class="card p-4 shadow-lg" style="max-width: 600px; margin: auto;">
        <h3 class="text-center mb-4">Ajouter un Travail</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('travail.store') }}">
            @csrf

            <!-- Secteur -->
            <div class="mb-3">
                <label for="secteur" class="form-label">Secteur</label>
                <select id="secteur" name="secteur" class="form-select" required>
                    <option value="" disabled selected>Choisir un secteur</option>
                    @foreach($secteurs as $secteur)
                        <option value="{{ $secteur }}">{{ $secteur }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Intitulé du Poste -->
            <div class="mb-3">
                <label for="intitule" class="form-label">Intitulé du Poste</label>
                <select id="intitule" name="intitule" class="form-select" required>
                    <option value="" disabled selected>Choisir un intitulé</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
            </div>

            <!-- Adresse -->
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input id="adresse" type="text" name="adresse" class="form-control" required>
            </div>

            <!-- Latitude et Longitude -->
            <input id="latitude" type="hidden" name="latitude">
            <input id="longitude" type="hidden" name="longitude">

            <button type="submit" class="btn btn-primary w-100">Ajouter Travail</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Vérifie si le navigateur supporte la géolocalisation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                // Remplit les champs latitude et longitude
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function (error) {
                console.error("Erreur de géolocalisation: ", error.message);
            });
        } else {
            console.error("Géolocalisation non supportée par ce navigateur.");
        }

        // Liste des métiers selon le secteur sélectionné
        const postes = {
            "Informatique": [
                "Développeur web",
                "Administrateur réseau",
                "Analyste de données",
                "Ingénieur Logiciel",
                "Vente de pc gamer"
            ],
            "Marketing": [
                "Responsable marketing",
                "Chargé de communication",
                "Analyste marketing",
                "Community manager"
            ],
            "Finance": [
                "Analyste financier",
                "Comptable",
                "Auditeur",
                "Contrôleur de gestion"
            ]
            // Ajoutez d'autres secteurs et métiers ici...
        };

        // Écouteur d'événements pour le changement de secteur
        document.getElementById('secteur').addEventListener('change', function () {
            const secteur = this.value;
            const intituleSelect = document.getElementById('intitule');

            // Réinitialise le dropdown des intitulés
            intituleSelect.innerHTML = '<option value="" disabled selected>Choisir un intitulé</option>';

            // Ajoute les métiers correspondant au secteur
            if (postes[secteur]) {
                postes[secteur].forEach(function(poste) {
                    const option = document.createElement('option');
                    option.value = poste;
                    option.textContent = poste;
                    intituleSelect.appendChild(option);
                });
            }
        });
    });
</script>
