<?php
require_once('Database.php');
$db = new Database;
$devices = $db->get_device();
?>
<html>
<head>
    <title>HappyPlants</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                            <div class="row no-bottom-margin">
                                <div class="col s6">
                                    <?php if (count($device['data']) > 0) {
                                        ?>
                                        <ul class="collection">
                                            <li class="collection-item">Temp: <?= $device['data']['temp'] ?>&deg;C</li>
                                            <li class="collection-item">Light: <?= $device['data']['moist'] ?> L</li>
                                            <li class="collection-item">Moist: <?= $device['data']['light'] ?> cB</li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col s6">

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
        }
        ?>
    </div>
</main>
<footer class="page-footer transparent">
    <div class="container">
        <div class="row">
            <a class="waves-effect waves-ligt btn blue left" id="btn-water-all" href="#">Geef water</a>
            <a class="waves-effect waves-light btn right" href="/modules.php" id="btn-modules">Beheer modules</a>
        </div>
    </div>
</footer>

<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
</body>
</html>