<?php
require_once('Database.php');
$db = new Database;
$devices = $db->get_device();
?>
<html>
<head>
    <title>HappyPlants</title>
    <link type="text/css" rel="stylesheet" href="assets/css/lib/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="assets/css/main.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/></head>
<body>
<header>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo left">Happyplants</a>
        </div>
    </nav>
</header>
<main>
    <div class="row no-bottom-margin">
        <?php
        if (count($devices) > 0) {
            foreach ($devices as $device) {
                ?>
                <div class="col s12 m6">
                    <div class="card"
                    data-name="<?= $device['name'] ?>"
                    data-address="<?= $device['address'] ?>">
                        <div class="card-content">
                            <span class="card-title"><?= $device['name'] ?></span>
                            <div class="row no-bottom-margin valign-wrapper">
                                <div class="col s6">
                                    <?php if (count($device['data']) > 0) {
                                        ?>
                                        <ul class="collection">
                                            <li class="collection-item"><i class="fa fa-fw fa-thermometer-three-quarters"></i> <?= $device['data']['temp'] ?>&deg;C</li>
                                            <li class="collection-item"><i class="fa fa-fw fa-sun-o"></i> <?= $device['data']['moist'] ?> L</li>
                                            <li class="collection-item"><i class="fa fa-fw fa-tint"></i> <?= $device['data']['light'] ?> cB</li>
                                        </ul>
                                        <?php
                                    } else {
                                        ?>
                                        <p>
                                            Nog geen gegevens beschikbaar
                                        </p>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col s6">
                                    <div class="card-panel">
                                        <img src="assets/img/<?= $device['crop'] ?>.png" alt="<?= $device['crop'] ?>" class="responsive-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <a href="#" class="btn-water">Geef water</a>
                            <a href="/detail.php?a=<?= urlencode($device['address']) ?>">Meer gegevens</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <p class="flow-text">
                Er zijn nog geen modules toegevoegd, druk op 'BEHEER MODULES' om modules te zoeken
            </p>
            <?php
        }
        ?>
    </div>
</main>
<footer class="page-footer transparent">
    <div class="container">
        <div class="row" style="margin-bottom: 5px">
            <a class="waves-effect waves-ligt btn blue left col s12 m2" id="btn-water-all" href="#">Geef water</a>
            <br class="hide-on-med-and-up">
            <br class="hide-on-med-and-up">
            <a class="waves-effect waves-light btn right col s12 m3" href="/modules.php" id="btn-modules">Beheer modules</a>
        </div>
    </div>
</footer>

<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
</body>
</html>