let map;
let markers = {};
let busRoute = [];

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 3.559263, lng: 98.660454 },
        zoom: 25
});

    userMarker = new google.maps.Marker({
        map: map,
        title: 'Lokasi Anda',
        icon: {
            url: 'img/people.png',
            scaledSize: new google.maps.Size(30, 30)
        }
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userPosition = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                userMarker.setPosition(userPosition);
                map.setCenter(userPosition);
            },
            () => {
                alert('Gagal mendapatkan lokasi pengguna.');
            }
        );
    } else {
        alert('Browser Anda tidak mendukung geolokasi.');
    }

    fetch('API/get_stops.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(stop => {
                addBusStop(stop.name, parseFloat(stop.latitude), parseFloat(stop.longitude));
            });
        });

    fetch('API/get_route.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                var coordinates = data.map(item => new google.maps.LatLng(parseFloat(item.latitude), parseFloat(item.longitude)));

                const firstCoordinate = new google.maps.LatLng(parseFloat(data[0].latitude), parseFloat(data[0].longitude));
                coordinates.push(firstCoordinate);

                const bounds = new google.maps.LatLngBounds();

                coordinates.forEach(coord => bounds.extend(coord));

                map.fitBounds(bounds);

                const routePath = new google.maps.Polyline({
                    path: coordinates,
                    geodesic: true,
                    strokeColor: '#008000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });

                routePath.setMap(map);
            } else {
                alert('No route data available.');
            }
        })
        .catch(error => console.error('Error fetching route data:', error));    
}

function addBusStop(name, lat, lng) {
    const icon = {
        url: 'img/halte.png',
        scaledSize: new google.maps.Size(30, 30)
    };

    const marker = new google.maps.Marker({
        position: { lat, lng },
        map: map,
        icon: icon,
        title: name
    });

    const infoWindow = new google.maps.InfoWindow({
        content: `<strong>${name}</strong>`
    });

    marker.addListener('click', () => {
        infoWindow.open(map, marker);
    }); 
}

function drawBusRoute(routeCoordinates) {
    const routePath = new google.maps.Polyline({
        path: routeCoordinates,
        geodesic: true,
        strokeColor: '#008000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    })
    routePath.setMap(map);
}


window.onload = initMap;

function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");

}