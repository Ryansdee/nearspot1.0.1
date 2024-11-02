function initMapForAddress(adresse, elementId, title) {
    // Ajout d'un contexte géographique (ex: Paris, France)
    var encodedAddress = encodeURIComponent(adresse + ", Paris, France");
    var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodedAddress}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log("Data from Nominatim:", data); // Pour vérifier les données dans la console
            if (data.length > 0) {
                var lat = data[0].lat;
                var lon = data[0].lon;

                var map = L.map(elementId).setView([lat, lon], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

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
    document.querySelectorAll('.map-container').forEach(container => {
        const address = container.getAttribute('data-address');
        const title = container.getAttribute('data-title');
        const mapId = container.id;
        
        initMapForAddress(address, mapId, title);
    });
});
