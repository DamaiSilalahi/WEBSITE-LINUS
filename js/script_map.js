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

function updateDriverLocation(platNomor, lat, lng, username) {
    console.log(`Lokasi diterima: Plat Nomor: ${platNomor}, Latitude: ${lat}, Longitude: ${lng}, Driver: ${username}`);

    if (markers[platNomor]) {
        animateMarkerToPosition(markers[platNomor], lat, lng, 2000);
    } else {
        const icon = {
            url: 'img/bus_ijo.png',
            scaledSize: new google.maps.Size(50, 50)
        };

        const marker = new google.maps.Marker({
            position: { lat, lng },
            map: map,
            icon: icon,
            title: `Plat Nomor: ${platNomor}`
        });

        const infoWindowContent = `
            <strong>Plat Nomor:</strong> ${platNomor}<br>
            <strong>Driver:</strong> ${username || 'Tidak diketahui'}
        `;

        const infoWindow = new google.maps.InfoWindow({
            content: infoWindowContent
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });

        markers[platNomor] = marker;
    }
}

function animateMarkerToPosition(marker, lat, lng, duration = 1000) {
    const startPosition = marker.getPosition();
    const endPosition = new google.maps.LatLng(lat, lng);
    const startTime = Date.now();

    function step() {
        const elapsedTime = Date.now() - startTime;
        const durationRatio = Math.min(elapsedTime / duration, 1);

        const currentLat = startPosition.lat() + (endPosition.lat() - startPosition.lat()) * durationRatio;
        const currentLng = startPosition.lng() + (endPosition.lng() - startPosition.lng()) * durationRatio;
        const currentPosition = new google.maps.LatLng(currentLat, currentLng);

        marker.setPosition(currentPosition);

        if (durationRatio < 1) {
            requestAnimationFrame(step);
        } else {
            marker.setPosition(endPosition);
        }
    }

    step();
}

google.maps.Marker.prototype.animateTo = function(newPosition, options) {
    var defaultOptions = {
        duration: 1000,
        easing: 'linear',
        complete: null
    };
    options = options || {};

    for (var key in defaultOptions) {
        options[key] = options[key] || defaultOptions[key];
    }

    if (options.easing !== 'linear' && (typeof jQuery === 'undefined' || !jQuery.easing[options.easing])) {
        throw '"' + options.easing + '" easing function doesn\'t exist. Include jQuery and/or the jQuery easing plugin and use the right function name.';
        return;
    }

    var currentLat = this.getPosition().lat();
    var currentLng = this.getPosition().lng();
    var targetLat = newPosition.lat();
    var targetLng = newPosition.lng();

    if (Math.abs(targetLng - currentLng) > 180) {
        if (targetLng > currentLng) {
            targetLng -= 360;
        } else {
            targetLng += 360;
        }
    }

    var animateStep = function(startTime) {
        var elapsed = (new Date()).getTime() - startTime;
        var durationRatio = elapsed / options.duration;
        var easingRatio = durationRatio;

        if (options.easing !== 'linear') {
            easingRatio = jQuery.easing[options.easing](durationRatio, elapsed, 0, 1, options.duration);
        }

        if (durationRatio < 1) {
            var newLat = currentLat + (targetLat - currentLat) * easingRatio;
            var newLng = currentLng + (targetLng - currentLng) * easingRatio;
            var newPos = new google.maps.LatLng(newLat, newLng);
            this.setPosition(newPos);

            requestAnimationFrame(function() { animateStep(startTime); });
        } else {
            this.setPosition(newPosition);
            if (typeof options.complete === 'function') {
                options.complete();
            }
        }
    };

    animateStep(new Date().getTime());
};

const ws = new WebSocket('ws://localhost:8080/bus-location');

ws.onmessage = function(event) {
    const data = JSON.parse(event.data);

    updateDriverLocation(data.plat_nomor, parseFloat(data.lat), parseFloat(data.lng), data.username);
};

window.onload = initMap;

function toggleSidebar() {
    var sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");

}