<?php
require_once('Controllers/Happyplants.php');
$page = new Happyplants('market');
?>
<html>
<head>
    <?php $page->get_header(); ?>
</head>
<body id="market">
<header>
    <?php $page->get_navigation('Markt'); ?>
</header>
<main>
    <div class="row no-bottom-margin">
        <div class="col s12 m5">
            <div class="card-panel">
                <div class="row">
                    <h3>Jouw groenten</h3>
                    <p>Klik op een groente om te zoeken welke mensen deze groente willen hebben.</p>
                    <span class="btn col s12 l6 offset-l3" id="show-all-btn">Laat alles zien</span>
                </div>
                <div class="row">
                    <?php
                    foreach ($page->devices as $device) {
                        ?>
                        <div class="owned-veg col s4 l3" data-veg="<?= $device['crop'] ?>">
                            <img src="/assets/img/<?= $device['crop'] ?>.png" alt="">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="card-panel statuspanel hidden">
                <div class="row">
                    <h3>Status</h3>
                </div>
                <div class="row">
                    <ul class="collection statuscollection">
                        <li class="collection-item hidden statusitemtemplate">
                            <div class="tradeoffer valign-wrapper">
                                <img src="/assets/img/#request#.png" alt="">
                                <span>voor</span>
                                <img src="/assets/img/#offer#.png" alt="">
                                <span>met #user# - status: in afwachting</span>
                                <a href="#" class="secondary-content">
                                    <i class="fa fa-fw mobilefix fa-trash-o"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-panel col s12 m6 offset-m1">
            <div id="map"></div>
        </div>
    </div>
</main>
<?php $page->get_footer('market'); ?>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTNSaqKB5p7uyDZAG5zhSz-kj5aWlEwlI&callback=initMap">
</script>
</body>
</html>