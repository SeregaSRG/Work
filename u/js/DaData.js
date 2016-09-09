$("#address").suggestions({
	serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
	token: "17ed65dcbcc11403174b3fb1a72e8af650cf7ae8",
	type: "ADDRESS",
	count: 5,
	onSelect: function(suggestion) {
		callPosition = null;
		callPosition = '{lat:'+suggestion.data.geo_lat+',lon:'+suggestion.data.geo_lon+'}';
		position = new google.maps.LatLng(suggestion.data.geo_lat,suggestion.data.geo_lon);
		callAddress = $('#address').val();
		$('#where').val(adr);
		map.setCenter(position);
		marker.setPosition(position);
		myalert("Местоположение отмечено на карте");
	}
});