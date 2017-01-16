<?php
require_once('Controllers/Happyplants.php');
$page = new Happyplants('market');
?>
<html>
<head>
    <?php $page->get_header(); ?>
</head>
<body>
<header>
    <?php $page->get_navigation('Markt'); ?>
</header>
<main>
    <div class="row no-bottom-margin">
        <div class="card-panel col s12 m5">
            <h3>Jouw groenten</h3>
            <?php
            foreach ($page->devices as $device) {
                ?>
                <img src="/assets/img/<?= $device['crop'] ?>.png" alt="" class="col s3">
                <?php
            }
            ?>
        </div>
        <div class="card-panel col s12 m6 offset-m1">
            <div id="map"></div>
            <script>
                function initMap() {
                    var rdm = {lat: 51.8975886, lng: 4.4185884};
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 13,
                        center: rdm,
                        streetViewControl: false
                    });
                    var marker = new google.maps.Marker({
                        position: rdm,
                        map: map
                    });
                }
            </script>
        </div>
    </div>
</main>
<?php $page->get_footer(); ?>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTNSaqKB5p7uyDZAG5zhSz-kj5aWlEwlI&callback=initMap">
</script>
</body>
</html>
