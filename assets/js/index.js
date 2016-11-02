$(document).ready(function() {
    $("#btn-water-all").on("click", give_water);
    $(".btn-water").on("click", send_command);
});

function give_water() {
    var data = {
        command: 'command_all'
    };
    if ($(this)[0].id != 'btn-water-all') {
        data = {
            command: 'command_all',
            comm: 2
        }
    }
    $.ajax({
        type: "POST",
        url: "/python/main.py",
        data: {
            command: 'command_all',
            comm: 2
        },
        success: function(data) {
            console.log(data);
        },
        error: function() {
            Materialize.toast('Fout', 4000);
            console.log('error');
        }
    });
}

function send_command() {
    var device = $(this).parent().parent().data();
    $.ajax({
        type: "POST",
        url: "/python/main.py",
        data: {
            command: 'command',
            comm: 2,
            address: device.address
        },
        success: function(data) {
            console.log(data);
        },
        error: function() {
            Materialize.toast('Fout', 4000);
            console.log('error');
        }
    });
}