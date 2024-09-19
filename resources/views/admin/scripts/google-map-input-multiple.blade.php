<script>
    var map;
    var marker;
    var autocomplete;
    var ipAddressDetail = 'input[name=address_detail]';
    let ipAddress = `input[name=pick_address_]`;
    let ipLat = `input[name=lat_pick_address_]`;
    let ipLng = `input[name=lng_pick_address_]`;
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

    $(document).ready(function () {
        updateLocation($(ipLat).val(), $(ipLng).val());
    });


    $(document).on('click', '#openModalPickAddress', function (e) {
        ipAddress = $(this).data('input');
        ipAddressDetail = $(this).data('address-detail');
        ipLat = $(this).data(`lat`);
        ipLng = $(this).data(`lng`);
        console.log(ipAddress, ipAddressDetail, ipLat, ipLng);
        $("#pickAddressDetail").val($(ipAddressDetail).val());
        addressDetail = $(ipAddressDetail).val();
    });

    $(document).on('change', '#pickAddressDetail', function (e) {
        addressDetail = $(this).val();
    });

    $(document).on('change', ipAddress, function () {
        changeAddress($(this).val());
    });

    $(document).on("mychangeAddressChanged", function () {
        $("#pickedAddress .show-text").text(address);
    });

    $(document).on('click', '#confirmPickAddress', function (e) {
        $(ipAddress).val(address);
        $(ipLat).val(lat);
        $(ipLng).val(lng);
        $("#pickPlace").val('');
    });

    function initMap() {
        const mapDiv = $('#resultMap');
        if (!mapDiv) {
            console.error('Map container element not found');
            return;
        }
        map = new google.maps.Map(document.getElementById('showMap'), {
            center: {lat: 10.762622, lng: 106.660172},
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
            componentRestrictions: {country: 'vn'} // Chỉ hiển thị địa chỉ ở Việt Nam
        };

        autocomplete = new google.maps.places.Autocomplete(document.getElementById('pickPlace'), options);

        autocomplete.addListener('place_changed', function () {
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
            changeAddress($('#pickPlace').val());
            $('#pickPlace').val('');
        });

        marker.addListener('dragend', function () {
            var newPosition = marker.getPosition();
            var request = {
                location: newPosition,
                radius: '20', // Bán kính tìm kiếm
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
    }
</script>
