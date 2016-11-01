$(document).ready(function() {
    $('#add-modules').on('click', add_modules_button);
});

function add_modules_button() {
    $.ajax({
        type: "POST",
        url: "/python/bt_scan_devices.py",
        success: function(data) {
            console.log(data);
            if (data.length > 0) {
                var ul = $("<ul></ul>").addClass("collection with-header");
                ul.append($("<li></li>").addClass("collection-header").append($("<h4></h4>").text("Gevonden modules")));
                $.each(data, function(index, value) {
                    ul.append($("<li></li>").addClass("collection-item founddevice").text(value[0]));
                });
                $("#found-modules").append(ul);
            } else {
                Materialize.toast('Geen modules gevonden', 4000)
            }
        },
        error: function() {
            console.log('error');
        }
    });
}