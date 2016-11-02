$(document).ready(function() {
    $('#saved-modules li.collection-item').on('click', remove_module);
    $('#add-modules').on('click', add_modules_button);
});

function add_modules_button() {
    var button = $(this);
    button.text('Zoeken..');
    $.ajax({
        type: "POST",
        url: "/python/main.py",
        data: {
            command: 'scan'
        },
        success: function(data) {
            if (data.length > 0) {
                var ul = $("<ul></ul>").addClass("collection with-header");
                ul.append($("<li></li>")
                    .addClass("collection-header")
                    .append($("<h4></h4>")
                        .text("Gevonden modules")
                    )
                )
                .append($("<li></li>")
                    .addClass("collection-item")
                    .text("HP Module")
                    .append($("<i></i>")
                        .addClass("secondary-content material-icons")
                        .text("add")
                    )
                    .data({
                        'name': "HP Module",
                        'address': '13:37:B1:FC:D1:A5'
                    })
                    .on("click", add_module)
                );
                $.each(data, function(index, value) {
                    ul.append(
                        $("<li></li>")
                        .addClass("collection-item")
                        .text(value[0])
                        .append(
                            $("<i></i>")
                            .addClass("secondary-content material-icons")
                            .text("add")
                        )
                        .data({
                            'name': value[0],
                            'address': value[1]
                        })
                        .on("click", add_module)
                    );
                });
                $("#found-modules").empty().append(ul);
            } else {
                Materialize.toast('Geen modules gevonden', 4000);
            }
            button.text('Voeg toe');
        },
        error: function() {
            Materialize.toast('Geen modules gevonden', 4000);
            console.log('error');
            button.text('Voeg toe');
        }
    });
}

function add_module() {
    var li = $(this);
    var device = li.data();
    $.ajax({
        type: "POST",
        url: "/python/main.py",
        data: {
            command: 'add',
            name: device.name,
            address: device.address
        },
        dataType: 'json',
        success: function() {
            Materialize.toast(device.name + ' is geregistreerd', 4000);
            li.remove();
            $("#saved-modules").append(
                $("<li></li>")
                    .addClass("collection-item")
                    .text(device.name)
                    .append(
                        $("<i></i>")
                            .addClass("secondary-content material-icons")
                            .text("delete")
                    )
                    .data({
                        'name': device.name,
                        'address': device.address
                    })
                    .on("click", remove_module)
            );
        },
        error: function() {
            Materialize.toast('Kan module niet registreren', 4000);
            console.log('error');
        }
    })
}

function remove_module() {
    var li = $(this);
    var device = li.data();
    $.ajax({
        type: "POST",
        url: "/python/main.py",
        data: {
            command: 'remove',
            name: device.name,
            address: device.address
        },
        dataType: 'json',
        success: function() {
            Materialize.toast(device.name + ' is verwijderd', 4000);
            li.remove();
        },
        error: function() {
            Materialize.toast('Kan module niet verwijderen', 4000);
            console.log('error');
        }
    })
}