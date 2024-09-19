@push('custom-js')
    <script>
        var endMap;
        var endMarker;
        var endAutocomplete;
        var ipEndAddress = 'input[name=end_address]';
        var ipEndAddressDetail = 'input[name=pick_end_address_detail]';
        var ipEndLat = "input[name=end_lat]";
        var ipEndLng = "input[name=end_lng]";
        var endAddress;
        var endAddressDetail = '';
        var endLat;
        var endLng;
        var endInfoWindow;

        function changeEndAddress(newValue) {
            endAddress = newValue;
            $(document).trigger("mychangeEndAddressChanged");
        }

        function updateLocation(lat, lng) {
            if (lat && lng) {
                var userLocation = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };
                endMarker.setPosition(userLocation);
                endMap.setCenter(userLocation);
                endMap.setZoom(17);
                changeEndAddress($(ipEndAddress).val());
                window.endLat = parseFloat(lat);
                window.endLng = parseFloat(lng);
            }
        }
        $(document).ready(function () {
            updateLocation($(ipEndLat).val(), $(ipEndLng).val());
        });

        $(document).on('click', '#openModalPickEndAddress', function (e) {
            ipEndAddress = $(this).data('input');
            ipEndAddressDetail = $(this).data('address-detail');
            ipEndLat = $(this).data('lat');
            ipEndLng = $(this).data('lng');
            $("#pickAddressDetail").val($(ipEndAddressDetail).val());
            $("#pickedEndAddress").val($(ipEndAddressDetail).val());
            endAddressDetail = $(ipEndAddressDetail).val();
        });

        $(document).on('change', '#pickEndAddressDetail', function (e) {
            endAddressDetail = $(this).val();
        });

        $(document).on('change', ipEndAddress, function () {
            changeEndAddress($(this).val());
        });

        $(document).on("mychangeEndAddressChanged", function () {
            $("#pickedEndAddress .show-text").text(endAddress);
        });

        $(document).on('click', '#confirmPickEndAddress', function (e) {
            $(ipEndAddress).val(endAddress);
            $(ipEndLat).val(endLat);
            $(ipEndLng).val(endLng);
            $(ipEndAddressDetail).val(endAddressDetail);
            $("#pickPlace").val('');

            // if (address) {
            //     $(ipAddress).removeAttr('readonly', 'readonly');
            // } else {
            //     $(ipAddress).attr('readonly', 'readonly');
            // }
        });

        function initEndMap() {
            endMap = new google.maps.Map(document.getElementById('showEndMap'), {
                center: {lat: 10.762622, lng: 106.660172},
                zoom: 12,
                gestureHandling: "cooperative"
            });

            endInfoWindow = new google.maps.InfoWindow();

            endMarker = new google.maps.Marker({
                map: endMap,
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
                componentRestrictions: {country: 'vn'} // Chỉ hiển thị địa chỉ ở Việt Nam
            };

            endAutocomplete = new google.maps.places.Autocomplete(document.getElementById('pickEndPlace'), options);

            endAutocomplete.addListener('place_changed', function () {
                var place = endAutocomplete.getPlace();
                if (!place.geometry) {
                    msgError(window.__trans('Không tìm thấy địa điểm:') + " '" + place.name + "'")
                    return;
                }

                if (place.geometry.viewport) {
                    endMap.fitBounds(place.geometry.viewport);
                } else {
                    endMap.setCenter(place.geometry.location);
                    endMap.setZoom(17);
                }

                endMarker.setPosition(place.geometry.location);
                endMap.setCenter(place.geometry.location);
                endLat = place.geometry.location.lat();
                endLng = place.geometry.location.lng();
                changeEndAddress($('#pickEndPlace').val());
                $('#pickEndPlace').val('');
            });

            endMarker.addListener('dragend', function () {
                var newPosition = endMarker.getPosition();
                var request = {
                    location: newPosition,
                    radius: '20', // Bán kính tìm kiếm
                    language: 'vi'
                };

                var service = new google.maps.places.PlacesService(endMap);

                service.nearbySearch(request, function (results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        if (results[0]) {
                            var placeDetailsRequest = {
                                placeId: results[0].place_id
                            };

                            service.getDetails(placeDetailsRequest, function (place, status) {
                                if (status === google.maps.places.PlacesServiceStatus.OK) {
                                    endLat = newPosition.lat();
                                    endLng = newPosition.lng();
                                    changeEndAddress(place.formatted_address);
                                }
                            });
                        }
                    }
                });
            });

            $(".cancel-pick-address").click(function () {

                if ($(ipEndLat).val() && $(ipEndLng).val()) {
                    updateLocation($(ipEndLat).val(), $(ipEndLng).val());
                } else {
                    changeEndAddress('');
                }
            });

            function getLocation() {

                if (navigator.geolocation) {
                    $("#getCurrentEndLocation .spinner-border").show();
                    navigator.geolocation.getCurrentPosition(function (position) {

                        var userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        endMarker.setPosition(userLocation);
                        endMap.setCenter(userLocation);
                        endMap.setZoom(17);



                        var newPosition = endMarker.getPosition();

                        var request = {
                            location: newPosition,
                            radius: '20'
                        };
                        var service = new google.maps.places.PlacesService(endMap);

                        service.nearbySearch(request, function (results, status) {
                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                if (results[0]) {
                                    var placeDetailsRequest = {
                                        placeId: results[0].place_id
                                    };

                                    service.getDetails(placeDetailsRequest, function (place, status) {
                                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                                            changeEndAddress(place.formatted_address);

                                            $(ipEndAddress).val(endAddress);
                                            endLat = newPosition.lat();
                                            endLng = newPosition.lng();
                                            $(ipEndLat).val(newPosition.lat());
                                            $(ipEndLng).val(newPosition.lng());
                                            $(document).trigger("mychangeEndAddressChanged");

                                            $("#getCurrentEndLocation .spinner-border").hide();
                                            $(ipEndAddress).removeAttr('readonly', 'readonly');
                                        }
                                    });
                                }
                            }
                        });
                    }, function () {
                        $("#getCurrentEndLocation .spinner-border").hide();
                        handleLocationError(true, endInfoWindow, endMap.getCenter());
                    }, {
                        enableHighAccuracy: true,
                        maximumAge: 0
                    });
                } else {
                    msgError(window.__trans('Trình duyệt không hỗ trợ lấy vị trí.'));
                    $("#getCurrentEndLocation .spinner-border").hide();
                }

            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.'
                );
            }

            document.getElementById('getCurrentEndLocation').addEventListener('click', getLocation);
        }

    </script>
@endpush
