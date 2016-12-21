$(document).ready(function() {
    var module = $("main");
    var address = module.data("address");
    var name = module.data("name");
    $(".select-crop").on("click", function() {
        var crop = $(this).data("crop");
        var newcrop = $(this).text();

        $.ajax({
            type: "POST",
            url: "Api.php",
            data: {
                endpoint: 'change-crop',
                address: address,
                crop: crop
            },
            success: function() {
                $("#current-crop").text(newcrop);
            },
            error: function() {
                Materialize.toast('Fout', 4000);
                console.log('error');
            }
        });
    });

    $("#change-name").on("click", function() {
        var popup = $("#change-name-popup");
        $("#name").val(name);
        $("#name-label").addClass("active");
        popup.removeClass("hidden");

        $("#change-name-cancel").on("click", function() {
            popup.addClass("hidden");
        })
    });

    $("#remove-module").on("click", function () {
        var popup = $("#remove-module-popup");
        popup.removeClass("hidden");

        $("#remove-module-cancel").on("click", function () {
            popup.addClass("hidden");
        })
    })
});