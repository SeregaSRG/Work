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
        geolocationFailure();
    }
}

function searchMyGeo() {
    // Пытаемся определить местоположение пользователя
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            geolocationSuccess, geolocationFailure);
        myalert("Поиск завершен");
    }
    else {
        myalert("Ваш браузер не поддерживает геолокацию");
        goToDefaultLocation();
    }
}
function geolocationSuccess(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    position = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

    // Отображаем эту точку на карте
    map.setCenter(position);
    marker.setPosition(position);
    $('#where').val('Отмечено на карте');
    myalert("Отмечено место на карте");
}

function geolocationFailure() {
    DEFAULT_POSITION = new google.maps.LatLng(lat,lon);
    map.setCenter(DEFAULT_POSITION);
}

function goToDefaultLocation() {
    map.setCenter(DEFAULT_POSITION);
}

function add_position() {
    adr = null;
    coord = '{lat:'+lat+',lon:'+lon+'}';
    //$('#map_main').hide()
    myalert("Отмечено место на карте");
}

function savePosition() {
    toggleGeoSelect();
    if (callAddress == null && callPosition == null) {
        myalert('Адрес не выбран')
    } else {
        $('#where_label').addClass('is-dirty');
    }
}

function showMap(data) {
    //$('#map_main').show();
    var myOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapSurface"), myOptions);
    position = new google.maps.LatLng(data.lat,data.lon);
    map.setCenter(position);

    marker = new google.maps.Marker({
        position: position,
        map: map,
        title: 'Место'
    });

    console.log(data.lon);
    console.log(data.lat);
}

