
var map = L.map('map', {
    attributionControl: false
}).setView([33.886917, 9.537499], 6);


var Esri_WorldStreetMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
});
Esri_WorldStreetMap.addTo(map);

var redIcon = L.icon({
    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
});

// Create a marker with the red icon
var markerFixed =L.marker([37, 9.5], {icon: redIcon}).addTo(map);


markerFixed.bindPopup("<b>Welcome!</b><br>You are in Tunisia.").openPopup();

var marker;

function onMapClick(e) {
    if (marker) {
        map.removeLayer(marker);
    }

    marker = L.marker(e.latlng).addTo(map);
    let latlng = e.latlng;

    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`;
    const options = {
        headers: {
            'accept-language': 'en'
        }
    };

    fetch(url, options)
        .then(response => response.json())
        .then(data => {
            let address = data.display_name;
            marker.bindPopup('You clicked on: '+address).openPopup();
            let locationField = document.querySelector('.location');
            locationField.value =address;
            console.log(locationField.value);

            console.log(latlng);

        })
        .catch(error => {
            console.error(error);
        });
}

map.on('click', onMapClick);






