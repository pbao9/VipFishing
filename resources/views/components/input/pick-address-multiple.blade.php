<div class="d-flex justify-content-between align-items-center">
				<label class="form-label">{{ $label }}</label>
				<div id="getCurrentLocationMultiple" class="text-danger d-flex align-items-center">
								<div class="spinner-border text-danger me-1" role="status" style="display: none;">
												<span class="visually-hidden">Loading...</span>
								</div>
								{{-- <span class="cursor-pointer">@lang("useCurrentLocation")</span> --}}
				</div>
</div>
<div class="input-group mb-2">
				<input id="hiddenName" type="text" {{ $attributes->class(["form-control"])->merge($isRequired()) }}
								name="{{ $name }}" readonly data-parsley-errors-container="#error{{ $name }}" />
				<button type="button" id="openModalPickAddress" class="btn text-danger fw-normal"
								data-input="input[name={{ $name }}]" data-lat="input[name=lat_{{ $name }}]"
								data-lng="input[name=lng_{{ $name }}]" data-address-detail="input[name=address_detail]"
								data-bs-toggle="modal" data-bs-target="#modalPickAddress">@lang("pickAddress")</button>
</div>
<div id="error{{ $name }}"></div>

<script>
				var openModalPickAddress = $('#openModalPickAddress');
				ipAddress = openModalPickAddress.data('input');
				ipLat = openModalPickAddress.data('lat');
				ipLng = openModalPickAddress.data('lng');
				if (navigator.geolocation) {
								$("#getCurrentLocationMultiple .spinner-border").show();
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
																																console.log(address, lat, lng);
																																$("#pickPlace").val('');
																																$("#getCurrentLocationMultiple .spinner-border").hide();
																												}
																								});
																				}
																}
												});
								}, function() {
												$("#getCurrentLocationMultiple .spinner-border").hide();
												handleLocationError(true, infoWindow, map.getCenter());
								}, {
												enableHighAccuracy: true,
												maximumAge: 0
								});
				} else {
								msgError(window.__trans('Trình duyệt không hỗ trợ lấy vị trí.'));
								$("#getCurrentLocationMultiple .spinner-border").hide();
				}

				// document.getElementById('getCurrentLocationMultiple').addEventListener('click', getLocation);
</script>
