<?php
require_once('Happyplants.php');
$page = new Happyplants('modules');
?>
<html>
<head>
    <title>HappyPlants</title>
    <link type="text/css" rel="stylesheet" href="assets/css/lib/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/main.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/></head>
<body>
<header>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo left">
                <i class="fa fa-angle-left mobilefix"></i>
                Modules
            </a>
        </div>
    </nav>
</header>
<main>
    <div class="row">
        <div class="col s12 m6">
            <ul class="collection with-header" id="saved-modules">
                <li class="collection-header"><h4>Opgeslagen modules</h4></li>
                <?php
                if ($page->has_devices()) {
                    foreach ($page->devices as $device) {
                        ?>
                        <li class="collection-item"
                            data-address="<?= $device['address'] ?>"
                            data-name="<?= $device['name'] ?>">
                            <?= $device['name'] ?> (<?=$device['address'] ?>)
                            <i class="secondary-content fa fa-trash-o fa-lg" style="line-height: inherit"></i>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="col s12 m6" id="new-module">
            <ul class="collection with-header">
                <li class="collection-header"><h4>Nieuwe module</h4></li>
                <li>
                    <form method="POST" class="col s12" action="modules.php">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="address" type="number" class="validate" name="address">
                                <label for="address">Happyplants ID</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="submit" class="btn col s12 m6 l3" value="Voeg toe" name="submit">
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</main>
<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/modules.js"></script>
</body>
</html>