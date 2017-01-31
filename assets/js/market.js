var markers = [];

$(document).ready(function() {
    $('.owned-veg').on('click', function() {
        $('.owned-veg').addClass('disabled');
        $(this).removeClass('disabled');
        filterMarkers($(this).data('veg'));
    });
    $('#show-all-btn').on('click', function() {
        $('.owned-veg').removeClass('disabled');
        filterMarkers('all');
    });
});

function initMap() {
    var rdm = {lat: 51.8975886, lng: 4.4185884};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: rdm,
        streetViewControl: false,
        gestureHandling: 'greedy'
    });

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "Api.php",
        data: {
            endpoint: 'get-markers'
        },
        success: function(data) {
            var count = 0;
            $.each(data, function(key, location) {
                count++;

                marker = new google.maps.Marker({
                    position: {
                        lat: location.lat,
                        lng: location.lng
                    },
                    category: location.request,
                    map: map
                });

                marker.infowindow = new google.maps.InfoWindow({
                    content:
                    '<div class="infowindow">' +
                        '<h5>' + location.user + '</h5>' +
                        '<div class="row valign-wrapper">' +
                            '<div class="col s5"><img src="/assets/img/' + location.request + '.png"></div>'+
                            '<div class="col s2"><i class="fa fa-fw fa-arrows-h fa-2x"></i></div>' +
                            '<div class="col s5"><img src="/assets/img/' + location.offer + '.png"></div>'+
                        '</div>' +
                        '<div class="row">' +
                            '<div class="tradebutton btn col s12">Ruilen</div>' +
                        '</div>' +
                    '</div>'
                });

                google.maps.event.addListener(marker.infowindow, 'domready', function() {
                    $('.tradebutton').on('click', function() {
                        addTrade(location);

                    });
                });

                marker.addListener('click', function() {
                    this.infowindow.open(map, this);
                });

                markers.push(marker);
            });
        },
        error: function() {
            Materialize.toast('Fout', 4000);
            console.log('error');
        }
    });
}

function filterMarkers(filter) {
    var results = false;
    for (i = 0; i < markers.length; i++) {
        marker = markers[i];
        if (marker.category == filter || filter == 'all') {
            marker.setVisible(true);
            results = true;
        } else {
            marker.setVisible(false);
            marker.infowindow.close();
        }
    }
    if (!results) {
        Materialize.toast('Geen resultaten gevonden', 4000);
    }
}

function addTrade(location) {
    var template = $('.statusitemtemplate').clone();
    template.html(template.html()
        .replace('#offer#', location.offer)
        .replace('#request#', location.request)
        .replace('#user#', location.user)
    );
    template.removeClass('statusitemtemplate hidden');
    $('.statuscollection').append(template);
    $('.statuspanel').removeClass('hidden');
}