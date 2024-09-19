@push("custom-js")
				<script>
								var map;
        let hiddenValue = $('.hidden-parent-id').val();
								var marker;
								var autocomplete;
								var ipAddressDetail = 'input[name=pick_address_multiple_detail]';
        let ipAddress = `input[name=pick_address_${hiddenValue}]`;
								let ipLat = `input[name=lat_pick_address_${hiddenValue}]`;
								let ipLng = `input[name=lng_pick_address_${hiddenValue}]`;
								var address;
								var addressDetail = '';
								var lat;
								var lng;
								var infoWindow;

								function changeAddress(newValue) {
												address = newValue;
												$(document).trigger("mychangeAddressChanged");
								}

								function updateLocation(lat, lng) {
												if (lat && lng) {
																var userLocation = {
																				lat: parseFloat(lat),
																				lng: parseFloat(lng)
																};
																marker.setPosition(userLocation);
																map.setCenter(userLocation);
																map.setZoom(17);
																changeAddress($(ipAddress).val());
																window.lat = parseFloat(lat);
																window.lng = parseFloat(lng);
												}
								}

								$(document).ready(function() {
            initMap();
												updateLocation($(ipLat).val(), $(ipLng).val());
								});

								$(document).on('click', '#openModalPickAddress', function(e) {
												ipAddress = $(this).data('input');
												ipAddressDetail = $(this).data('address-detail');
            ipLat = $(this).data(`lat`);
            ipLng = $(this).data(`lng`);
												$("#pickAddressDetail").val($(ipAddressDetail).val());
												addressDetail = $(ipAddressDetail).val();
								});

								$(document).on('change', '#pickAddressMultipleDetail', function(e) {
												addressDetail = $(this).val();
								});

								$(document).on('change', ipAddress, function() {
												changeAddress($(this).val());
								});

								$(document).on("mychangeAddressChanged", function() {
												$("#pickedAddressMultiple .show-text").text(address);
								});

								$(document).on('click', '#confirmPickAddress', function(e) {
												$(ipAddress).val(address);
												$(ipLat).val(lat);
												$(ipLng).val(lng);
            $(ipAddressDetail).val(addressDetail);
												$("#pickPlaceMultiple").val('');
								});

								function initMap() {
												const mapDiv = $('#showMapMultiple');
												if (!mapDiv) {
																console.error('Map container element not found');
																return;
												}
												map = new google.maps.Map(document.getElementById('showMapMultiple'), {
																center: {
																				lat: 10.762622,
																				lng: 106.660172
																},
																zoom: 12,
																gestureHandling: "cooperative"
												});

												infoWindow = new google.maps.InfoWindow();

												marker = new google.maps.Marker({
																map: map,
																draggable: true
												});

												// Tạo một biến để lưu trữ giới hạn địa lý cho Autocomplete
												var vietnamBounds = new google.maps.LatLngBounds(
																new google.maps.LatLng(8.19, 102.144),
																new google.maps.LatLng(23.393395, 109.464582)
												);

												// Thiết lập giới hạn địa lý cho Autocomplete
												var options = {
																bounds: vietnamBounds,
																componentRestrictions: {
																				country: 'vn'
																} // Chỉ hiển thị địa chỉ ở Việt Nam
												};

												autocomplete = new google.maps.places.Autocomplete(document.getElementById('pickPlaceMultiple'), options);

												autocomplete.addListener('place_changed', function() {
																var place = autocomplete.getPlace();
																if (!place.geometry) {
																				msgError(window.__trans('Không tìm thấy địa điểm:') + " '" + place.name + "'")
																				return;
																}

																if (place.geometry.viewport) {
																				map.fitBounds(place.geometry.viewport);
																} else {
																				map.setCenter(place.geometry.location);
																				map.setZoom(17);
																}

																marker.setPosition(place.geometry.location);
																map.setCenter(place.geometry.location);
																lat = place.geometry.location.lat();
																lng = place.geometry.location.lng();
																changeAddress($('#pickPlaceMultiple').val());
																$('#pickPlaceMultiple').val('');
												});

												marker.addListener('dragend', function() {
																var newPosition = marker.getPosition();
																var request = {
																				location: newPosition,
																				radius: '20', // Bán kính tìm kiếm
																				language: 'vi'
																};

																var service = new google.maps.places.PlacesService(map);

																service.nearbySearch(request, function(results, status) {
																				if (status == google.maps.places.PlacesServiceStatus.OK) {
																								if (results[0]) {
																												var placeDetailsRequest = {
																																placeId: results[0].place_id
																												};

																												service.getDetails(placeDetailsRequest, function(place, status) {
																																if (status === google.maps.places.PlacesServiceStatus.OK) {
																																				lat = newPosition.lat();
																																				lng = newPosition.lng();
																																				changeAddress(place.formatted_address);
																																}
																												});
																								}
																				}
																});
												});

												$(".cancel-pick-address").click(function() {

																if ($(ipLat).val() && $(ipLng).val()) {
																				updateLocation($(ipLat).val(), $(ipLng).val());
																} else {
																				changeAddress('');
																}
												});

												function getLocation() {

																if (navigator.geolocation) {
																				$("#getCurrentLocation .spinner-border").show();
																				navigator.geolocation.getCurrentPosition(function(position) {

																								var userLocation = {
																												lat: position.coords.latitude,
																												lng: position.coords.longitude
																								};
																								marker.setPosition(userLocation);
																								map.setCenter(userLocation);
																								map.setZoom(17);


																								var newPosition = marker.getPosition();

																								var request = {
																												location: newPosition,
																												radius: '20'
																								};
																								var service = new google.maps.places.PlacesService(map);

																								service.nearbySearch(request, function(results, status) {
																												if (status == google.maps.places.PlacesServiceStatus.OK) {
																																if (results[0]) {
																																				var placeDetailsRequest = {
																																								placeId: results[0].place_id
																																				};

																																				service.getDetails(placeDetailsRequest, function(place, status) {
																																								if (status === google.maps.places.PlacesServiceStatus.OK) {
																																												changeAddress(place.formatted_address);

																																												$(ipAddress).val(address);
																																												lat = newPosition.lat();
																																												lng = newPosition.lng();
																																												$(ipLat).val(newPosition.lat());
																																												$(ipLng).val(newPosition.lng());
																																												$(document).trigger("mychangeAddressChanged");

																																												$("#getCurrentLocation .spinner-border").hide();
																																												$(ipAddress).removeAttr('readonly', 'readonly');
																																								}
																																				});
																																}
																												}
																								});
																				}, function() {
																								$("#getCurrentLocation .spinner-border").hide();
																								handleLocationError(true, infoWindow, map.getCenter());
																				}, {
																								enableHighAccuracy: true,
																								maximumAge: 0
																				});
																} else {
																				msgError(window.__trans('Trình duyệt không hỗ trợ lấy vị trí.'));
																				$("#getCurrentLocation .spinner-border").hide();
																}

												}

												function handleLocationError(browserHasGeolocation, infoWindow, pos) {
																infoWindow.setPosition(pos);
																infoWindow.setContent(browserHasGeolocation ?
																				'Error: The Geolocation service failed.' :
																				'Error: Your browser doesn\'t support geolocation.'
																);
												}

												$("#getCurrentLocation").click(getLocation);
								}
				</script>
@endpush
