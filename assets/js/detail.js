$(document).ready(function() {
    $(".select-crop").on("click", function() {
        var crop = $(this).data("crop");
        var address = $("main").data("device");
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
});