@push('custom-js')
    <script>
        var mapUser;
        var markerUser;
        var autocompleteUser;
        var ipAddressUser = 'input[name=user_address]';
        var ipAddressDetailUser = 'input[name=pick_address_user_detail]';
        var ipLatUser = "input[name=user_lat]";
        var ipLngUser = "input[name=user_lng]";
        var addressUser;
        var addressDetailUser = '';
        var latUser;
        var lngUser;
        var infoWindowUser;

        function changeAddress(newValue) {
            addrmapUser = newValue;
            $(document).trigger("mychangeAddressChanged");
        }

        function updateLocation(lat, lng) {
            if (lat && lng) {
                var userLocation = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };
                marker.setPosition(userLocation);
                mapUser.setCenter(userLocation);
                mapUser.setZoom(17);
                changeAddress($(ipAddress).val());
                window.lat = parseFloat(lat);
                window.lng = parseFloat(lng);
            }
        }

        $(document).ready(function () {
            initMapUser();
            updateLocation($(ipLat).val(), $(ipLng).val());
        });

        $(document).on('click', '#openModalPickAddressUser', function (e) {
            ipAddressUser = $(this).data('input');
            ipAddressDetailUser = $(this).data('address-detail');
            ipLatUser = $(this).data('lat');
            ipLngUser = $(this).data('lng');
            $("#pickAddressUserDetail").val($(ipAddressDetailUser).val());
            addressDetailUser = $(ipAddressDetail).val();

        });

        $(document).on('change', '#pickAddressUserDetail', function (e) {
            addressDetailUser = $(this).val();
        });

        $(document).on('change', ipAddressUser, function () {
            changeAddress($(this).val());
        });

        $(document).on("mychangeAddressChanged", function () {
            $("#pickedAddressUser .show-text").text(addressUser);
        });

        $(document).on('click', '#confirmPickAddressUser', function (e) {
            $(ipAddress).val(addressUser);
            $(ipLat).val(lat);
            $(ipLng).val(lng);
            $(ipAddressDetailUser).val(addressDetailUser);
            $("#pickPlaceUser").val('');
        });

        function initMapUser() {
            const mapDiv = $('#showMapUser');
            if (!mapDiv.length) {
                console.error('Map container element not found');
                return;
            }
            mapUser = new google.maps.Map(document.getElementById('showMapUser'), {
                center: {lat: 10.762622, lng: 106.660172},
                zoom: 12,
                gestureHandling: "cooperative"
            });

            infoWindowUser = new google.maps.InfoWindow();

            markerUser = new google.maps.Marker({
                map: map,
                draggable: true
            });

            // Define bounds for Vietnam
            var vietnamBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(8.19, 102.144),
                new google.maps.LatLng(23.393395, 109.464582)
            );

            // Set options for autocomplete
            var options = {
                bounds: vietnamBounds,
                componentRestrictions: {country: 'vn'}
            };

            autocompleteUser = new google.maps.places.Autocomplete(document.getElementById('pickPlaceUser'), options);

            autocompleteUser.addListener('place_changed', function () {
                var place = autocompleteUser.getPlace();
                if (!place.geometry) {
                    alert('Không tìm thấy địa điểm: ' + place.name);
                    return;
                }

                if (place.geometry.viewport) {
                    mapUser.fitBounds(place.geometry.viewport);
                } else {
                    mapUser.setCenter(place.geometry.location);
                    mapUser.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                mapUser.setCenter(place.geometry.location);
                latUser = place.geometry.location.lat();
                lngUser = place.geometry.location.lng();
                changeAddress($('#pickPlaceUser').val());
                $('#pickPlaceUser').val('');
            });

            marker.addListener('dragend', function () {
                var newPosition = marker.getPosition();
                var request = {
                    location: newPosition,
                    radius: '20',
                    language: 'vi'
                };

                var service = new google.maps.places.PlacesService(map);

                service.nearbySearch(request, function (results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        if (results[0]) {
                            var placeDetailsRequest = {
                                placeId: results[0].place_id
                            };

                            service.getDetails(placeDetailsRequest, function (place, status) {
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

            $(".cancel-pick-address").click(function () {
                if ($(User).val() && $(ipLngUser).val()) {
                    updateLocation($(ipLatUser).val(), $(ipLngUser).val());
                } else {
                    changeAddress('');
                }
            });

            function getLocation() {
                if (navigator.geolocation) {
                    $("#getCurrentLocation .spinner-border").show();
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        marker.setPosition(userLocation);
                        mapUser.setCenter(userLocation);
                        mapUser.setZoom(17);

                        var newPosition = marker.getPosition();
                        var request = {
                            location: newPosition,
                            radius: '20'
                        };
                        var service = new google.maps.places.PlacesService(map);

                        service.nearbySearch(request, function (results, status) {
                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                if (results[0]) {
                                    var placeDetailsRequest = {
                                        placeId: results[0].place_id
                                    };

                                    service.getDetails(placeDetailsRequest, function (place, status) {
                                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                                            changeAddress(place.formatted_address);
                                            $(ipAddressUser).val(addressUser);
                                            latUser = newPosition.lat();
                                            lngUser = newPosition.lng();
                                            $(ipLatUser).val(newPosition.lat());
                                            $(ipLngUser).val(newPosition.lng());
                                            $(document).trigger("mychangeAddressChanged");
                                            $("#getCurrentLocation .spinner-border").hide();
                                            $(ipAddressUser).removeAttr('readonly');
                                        }
                                    });
                                }
                            }
                        });
                    }, function () {
                        $("#getCurrentLocation .spinner-border").hide();
                        handleLocationError(true, infoWindowUser, mapUser.getCenter());
                    }, {
                        enableHighAccuracy: true,
                        maximumAge: 0
                    });
                } else {
                    alert('Trình duyệt không hỗ trợ lấy vị trí.');
                    $("#getCurrentLocation .spinner-border").hide();
                }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Lỗi: Dịch vụ định vị không hoạt động.' :
                    'Lỗi: Trình duyệt của bạn không hỗ trợ định vị.');
                infoWindow.open(mapUser);
            }

            $("#getCurrentLocation").click(getLocation);
        }
    </script>
@endpush
