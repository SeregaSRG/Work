var lat = 47.217848;
var lon = 39.694688;
var map;
var DEFAULT_POSITION = new google.maps.LatLng(lat,lon);
var marker = null;
var position = null;
var currentPosition = null;

function geo() {
    var myOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    // Создаем карту
    map = new google.maps.Map(document.getElementById("mapSurface"), myOptions);

    marker = new google.maps.Marker({
        position: DEFAULT_POSITION,
        map: map,
        title: 'Вы здесь!'
    });
    map.addListener('click', function(e) {
        lon = e.latLng.lng();
        lat = e.latLng.lat();
        position = e.latLng;
        marker.setPosition(position);
        map.setCenter(position);
        callAddress = 'Отмечено на карте';
        callPosition = '{lat:'+lat+',lon:'+lon+'}';
        $('#address').val('');
        $('#where').val('Отмечено на карте');
    });

    if (callAddress != null || callPosition != null) {
        currentPosition = new google.maps.LatLng(lat,lon);
        map.setCenter(currentPosition);
        marker.setPosition(currentPosition);
    } else {
        goToDefaultLocation();
    }
}

function goToDefaultLocation() {
    DEFAULT_POSITION = new google.maps.LatLng(lat,lon);
    map.setCenter(DEFAULT_POSITION);
}

function savePosition1() {
    toggleGeoSelect();
    if (callAddress == null && callPosition == null) {
        myalert('Адрес не выбран')
    } else {
        $('#where_label').addClass('is-dirty');
    }
}