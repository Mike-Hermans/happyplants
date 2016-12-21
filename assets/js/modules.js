$(document).ready(function() {
    $('#saved-modules li.collection-item').on('click', remove_module);
});

function remove_module() {
    var li = $(this);
    var device = li.data();
    $.ajax({
        type: "POST",
        url: "Api.php",
        data: {
            endpoint: 'remove-module',
            address: device.address
        },
        success: function(data) {
            console.log(data);
            Materialize.toast(device.name + ' is verwijderd', 4000);
            li.remove();
        },
        error: function() {
            Materialize.toast('Kan module niet verwijderen', 4000);
            console.log('error');
        }
    })
}