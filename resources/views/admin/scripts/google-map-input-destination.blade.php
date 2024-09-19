
@push('custom-js')
    <script>
        var destinationMap;
        var destinationMarker;
        var destinationAutocomplete;
        var ipDestinationAddress = 'input[name=destination_address]';
        var ipDestinationAddressDetail = 'input[name=destination_address_detail]';
        var ipDestinationLat = "input[name=destination_lat]";
        var ipDestinationLng = "input[name=destination_lng]";
        var destinationAddress;
        var destinationAddressDetail = '';
        var destinationLat;
        var destinationLng;
        var destinationInfoWindow;

        function changeDestinationAddress(newValue) {
            destinationAddress = newValue;
            $(document).trigger("destinationAddressChanged");
        }

        function updateDestinationLocation(lat, lng){
            if(lat && lng){
                var userLocation = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };
                destinationMarker.setPosition(userLocation);
                destinationMap.setCenter(userLocation);
                destinationMap.setZoom(17);
                changeDestinationAddress($(ipDestinationAddress).val());
                window.destinationLat = parseFloat(lat);
                window.destinationLng = parseFloat(lng);
            }
        }

        $(document).ready(function(){
            updateDestinationLocation($(ipDestinationLat).val(), $(ipDestinationLng).val());
        });

        $(document).on('click', '#openModalDestinationAddress', function(e){
            ipDestinationAddress = $(this).data('input');
            ipDestinationAddressDetail = $(this).data('address-detail');
            ipDestinationLat = $(this).data('lat');
            ipDestinationLng = $(this).data('lng');
            $("#pickAddressDetail").val($(ipAddressDetail).val());
            $("#pickedDestinationAddress").val($(ipDestinationAddress).val());
            destinationAddressDetail = $(ipDestinationAddress).val();
        });
        $(document).on('change', '#destinationAddressDetail', function(e){
            destinationAddressDetail = $(this).val();
        });

        $(document).on('change', ipDestinationAddress, function() {
            changeDestinationAddress($(this).val());
        });

        $(document).on("destinationAddressChanged", function() {
            $("#pickedDestinationAddress .show-text").text(destinationAddress);
        });

        $(document).on('click', '#confirmDestinationAddress', function(e){
            $(ipDestinationAddress).val(destinationAddress);
            $(ipDestinationLat).val(destinationLat);
            $(ipDestinationLng).val(destinationLng);
            $(ipDestinationAddressDetail).val(destinationAddressDetail);
            $("#destinationPlace").val('');

            // if(destinationAddress){
            //     $(ipDestinationAddress).removeAttr('readonly', 'readonly');
            // }else{
            //     $(ipDestinationAddress).attr('readonly', 'readonly');
            // }
        });
        function getDestinationLocation() {
            if (navigator.geolocation) {
                $("#getCurrentDestinationLocation .spinner-border").show();
                navigator.geolocation.getCurrentPosition(function(position) {

                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    destinationMarker.setPosition(userLocation);
                    destinationMap.setCenter(userLocation); // Đặt trung tâm của bản đồ là vị trí hiện tại
                    destinationMap.setZoom(17);

                    var newPosition = destinationMarker.getPosition();

                    var request = {
                        location: newPosition,
                        radius: '20'
                    };
                    var service = new google.maps.places.PlacesService(destinationMap);

                    service.nearbySearch(request, function(results, status) {
                        if (status == google.maps.places.PlacesServiceStatus.OK) {
                            if (results[0]) {
                                var placeDetailsRequest = {
                                    placeId: results[0].place_id
                                };

                                service.getDetails(placeDetailsRequest, function(place, status) {
                                    if (status === google.maps.places.PlacesServiceStatus.OK) {

                                        changeDestinationAddress(place.formatted_address);

                                        $(ipDestinationAddress).val(destinationAddress);

                                        $(ipDestinationLat).val(newPosition.lat());
                                        $(ipDestinationLng).val(newPosition.lng());
                                        $("#getCurrentDestinationLocation .spinner-border").hide();
                                        $(ipDestinationAddress).removeAttr('readonly', 'readonly');
                                        destinationLat = position.coords.latitude;
                                        destinationLng = position.coords.longitude;
                                        $(ipDestinationLat).val(lat);
                                        $(ipDestinationLng).val(lng);
                                        $(document).trigger("destinationAddressChanged");
                                    }
                                });
                            }
                        }
                    });
                }, function() {
                    $("#getCurrentDestinationLocation .spinner-border").hide();
                    handleLocationError(true, destinationInfoWindow, destinationMap.getCenter());
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 0
                });
            } else {
                msgError(window.__trans('Trình duyệt không hỗ trợ lấy vị trí.'));
                $("#getCurrentDestinationLocation .spinner-border").hide();
            }
            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.'
                );
            }
        }
        $(document).ready(function() {
            $('#getCurrentDestinationLocation').click(getDestinationLocation);
        });
        $(".cancel-destination-address").click(function(){

            if($(ipDestinationLat).val() && $(ipDestinationLng).val()){
                updateDestinationLocation($(ipDestinationLat).val(), $(ipDestinationLng).val());
            }else{
                changeDestinationAddress('');
            }
        });

        function initDestinationMap() {
            const mapDiv = $('#resultMap');
            if (!mapDiv) {
                console.error('Map container element not found');
                return;
            }
            destinationMap = new google.maps.Map(document.getElementById('showDestinationMap'), {
                center: { lat: 10.762622, lng: 106.660172 },
                zoom: 12,
                gestureHandling: "cooperative"
            });

            destinationInfoWindow = new google.maps.InfoWindow();

            destinationMarker = new google.maps.Marker({
                map: destinationMap,
                draggable: true
            });
            var vietnamBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(8.19, 102.144),
                new google.maps.LatLng(23.393395, 109.464582)
            );
            var options = {
                bounds: vietnamBounds,
                componentRestrictions: { country: 'vn' } // Chỉ hiển thị địa chỉ ở Việt Nam
            };

            destinationAutocomplete = new google.maps.places.Autocomplete(document.getElementById('destinationPlace'), options);

            destinationAutocomplete.addListener('place_changed', function() {
                var place = destinationAutocomplete.getPlace();
                if (!place.geometry) {
                    msgError(window.__trans('Không tìm thấy địa điểm:') + " '" + place.name + "'")
                    return;
                }

                if (place.geometry.viewport) {
                    destinationMap.fitBounds(place.geometry.viewport);
                } else {
                    destinationMap.setCenter(place.geometry.location);
                    destinationMap.setZoom(17);
                }


                destinationMarker.setPosition(place.geometry.location);
                destinationMap.setCenter(place.geometry.location);
                destinationLat = place.geometry.location.lat();
                destinationLng = place.geometry.location.lng();
                changeDestinationAddress($('#destinationPlace').val());
                $('#destinationPlace').val('');
            });

            destinationMarker.addListener('dragend', function() {
                var newPosition = destinationMarker.getPosition();
                var request = {
                    location: newPosition,
                    radius: '20', // Bán kính tìm kiếm
                    language: 'vi'
                };
                var service = new google.maps.places.PlacesService(destinationMap);

                service.nearbySearch(request, function(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        if (results[0]) {
                            var placeDetailsRequest = {
                                placeId: results[0].place_id
                            };

                            service.getDetails(placeDetailsRequest, function(place, status) {
                                if (status === google.maps.places.PlacesServiceStatus.OK) {
                                    destinationLat = newPosition.lat();
                                    destinationLng = newPosition.lng();
                                    changeDestinationAddress(place.formatted_address);
                                }
                            });
                        }
                    }
                });
            });
        }

    </script>
@endpush
