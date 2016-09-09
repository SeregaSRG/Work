var lat = 47.217848;
var lon = 39.694688;
var map;
var rnd = new google.maps.LatLng(lat,lon);
var marker = null;
var position = null;

function geo() {
	//$('#map_main').show();
	var myOptions = {
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	// Создаем карту
	map = new google.maps.Map(document.getElementById("mapSurface"), myOptions);

	geolocationFailure();

	marker = new google.maps.Marker({
		position: rnd,
		map: map,
		title: 'Вы здесь!'
	});

	map.addListener('click', function(e) {
		//lat = e.latLng.;
		lon = e.latLng.lng();
		lat = e.latLng.lat();
		position = e.latLng;
		marker.setPosition(position);
		map.setCenter(position);
		$('#address').val('');
		$('#where').val('Отмечено на карте');
	});
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
	rnd = new google.maps.LatLng(lat,lon);
	map.setCenter(rnd);
}

function goToDefaultLocation() {
	map.setCenter(rnd);
}

function add_position() {
	adr = null;
	coord = '{lat:'+lat+',lon:'+lon+'}';
	//$('#map_main').hide()
	myalert("Отмечено место на карте");
}

function selectGeo_save() {
	toggleGeoSelect();
	$('#where_label').addClass('is-dirty');
	coord = '{lat:'+lat+',lon:'+lon+'}';
	myalert("Отмечено место на карте");
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

