/* global locations, google, CURRENT_DATE, textUtils, arraysDates, notify, zWindow */

var currentZoom = 15;
var markers = [];
var circulos = [];
var map;
var GoogleMaps = function () {
    var mapMarker = function () {
        if (locations.length === 0) {
            map = new GMaps({
                div: '#gmap_marker',
                scrollwheel: false,
                lat: -8.057838,
                lng: -34.882897,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 14
            });

            return;
        }

        map = new GMaps({
            div: '#gmap_marker',
            scrollwheel: false,
            lat: locations[0].lat,
            lng: locations[0].lng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: currentZoom
        });

        var circles = map.polygons;
        if (circles) {
            for (var idx = 0; idx < circles.length; idx++) {
                circles[idx].setMap(null);
            }
        }
        map.cleanRoute();
        for (var i = 0; i < locations.length; i++) {
            var precisao = 0;
            if (locations[i].precision < 1000) {
                precisao = (locations[i].precision).toFixed(0) + "m";
            } else {
                precisao = (locations[i].precision / 1000).toFixed(1) + "km";
            }

            var _html = "<h5>" + locations[i].id + " - " + locations[i].nome + "</h5><br />";
            _html += "<p>";
            _html += "<strong>Data:</strong> " + locations[i].datalocalizacao + "<br />";
            _html += "<strong>Endereço:</strong> " + locations[i].endereco + "<br />";
            _html += "<strong>Coordenadas:</strong> " + locations[i].lat + ", " + locations[i].lng + "<br />";
            _html += "<strong>Precisão: </strong>" + precisao + "<br />";
            _html += "</p>";

            var marker = map.addMarker({
                lat: locations[i].lat,
                lng: locations[i].lng,
                title: locations[i].nome,
                icon: `../app/assets/img/placeholder-${Math.floor(Math.random() * (10 - 1) + 1)}.png`,
                infoWindow: {
                    content: _html
                }
            });

            var circulo = map.drawCircle({
                strokeColor: "#8aa9d2",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#cbd6da",
                fillOpacity: 0.35,
                center: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                radius: parseFloat(locations[i].precision)
            });

            markers.push({
                id: locations[i].id,
                marker: marker
            });

            circulos.push({
                id: locations[i].id,
                circulo: circulo
            });
        }
    };
    return {
        init: function () {
            mapMarker();
        }
    };
}();

var mapa = {
    centralizarMapa: function (lat, lng) {
        if (map !== null) {
            map.setCenter(lat, lng);
            var atualZoom = map.getZoom();
            if (atualZoom !== 18) {
                var z = 0;
                if (map.zoom > 18) {
                    z = atualZoom + 18;
                    map.zoomIn(z);
                } else {
                    z = atualZoom - 18;
                    map.zoomOut(z);
                }
            }
            //$("html, body").stop().animate({scrollTop: 200}, '500', 'swing', null);
        }
    }
};
GoogleMaps.init();