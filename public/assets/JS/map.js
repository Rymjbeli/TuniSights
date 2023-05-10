    // Create a new map centered on Tunisia
    var map = L.map('map', {
        attributionControl: false
    }).setView([33.886917, 9.537499], 6);

    // Add a tile layer from Esri World Street Map
    var Esri_WorldStreetMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
    });
    Esri_WorldStreetMap.addTo(map);

    // Create a new red marker icon for the Fixed marker(showing Tunisia)
    var redIcon = L.icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
    });

    // Create a fixed marker with the red icon and add it to the map
    var fixedMarker =L.marker([37, 9.5], {icon: redIcon}).addTo(map);

    // Add a popup to the fixed marker
    fixedMarker.bindPopup("<b>Welcome!</b><br>You are in Tunisia.").openPopup();

    var marker;
    // Define a function to handle map clicks
    function onMapClick(e) {
        if (marker) {
            map.removeLayer(marker);
        }


        // Add a new marker to the map at the clicked location
    marker = L.marker(e.latlng).addTo(map);
    let latlng = e.latlng;

        // Get the address at the clicked location and set the marker popup and location field value
        getAddress(latlng)
        .then(address => {
            setMarkerPopup(marker, address);
            setLocationFieldValue(address);
            console.log(locationField.value);
            console.log(latlng);
        })
        .catch(error => {
            console.error(error);
        });
}
    // Define a function to get the address at a given latlng coordinate
    function getAddress(latlng) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlng.lat}&lon=${latlng.lng}`;
        const options = {
            //Change the language of the address to the english
            headers: {
                'accept-language': 'en'
            }
        };

        // Make the HTTP request and parse the response JSON to extract the address field.
        return fetch(url, options)
            .then(response => response.json())
            .then(data => data.display_name);
    }

    // Define a function to set the popup of a marker to a given address
    function setMarkerPopup(marker, address) {
        marker.bindPopup('You clicked on: ' + address).openPopup();
    }

    // Define a function to set the value of the location field to a given address
    function setLocationFieldValue(address) {
        let locationField = document.querySelector('.location');
        locationField.value = address;
    }

    // Add the onMapClick function as a click event listener to the map
    map.on('click', onMapClick);






