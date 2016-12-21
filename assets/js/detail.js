$(document).ready(function() {
    var module = $("main");
    var address = module.data("address");
    var name = module.data("name");

    get_graphs(address);

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

function get_graphs(address) {
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "Api.php",
        data: {
            endpoint: "get-data",
            address: address
        },
        success: function(data) {
            var chartTemp = new Chart($("#chartTemp"), {
                type: 'line',
                data: {
                    labels: data.timestamp,
                    datasets: [
                        {
                            label: "Temperatuur",
                            data: data.temp,
                            backgroundColor: "rgba(239, 83, 80, 0.6)"
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            var chartLight = new Chart($("#chartLight"), {
                type: 'line',
                data: {
                    labels: data.timestamp,
                    datasets: [
                        {
                            label: "Licht",
                            data: data.light,
                            backgroundColor: "rgba(255, 238, 88, 0.6)"
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            var chartMoist = new Chart($("#chartMoist"), {
                type: 'line',
                data: {
                    labels: data.timestamp,
                    datasets: [
                        {
                            label: "Vochtigheid",
                            data: data.moist,
                            backgroundColor: "rgba(41, 182, 246, 0.6)"
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
}