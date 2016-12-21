<?php
require_once('Happyplants.php');
$page = new Happyplants('detail');
$device = $page->device;
$crops = $page->crops;
?>
<html>
<head>
    <title>HappyPlants</title>
    <link type="text/css" rel="stylesheet" href="assets/css/lib/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="assets/css/main.css" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
</head>
<body>
<header>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo left">
                <i class="fa fa-angle-left mobilefix"></i>
                <?= $device['name'] ?>
            </a>
        </div>
    </nav>
</header>
<main data-address="<?= $device['address'] ?>" data-name="<?= $device['name'] ?>">
    <div class="row no-bottom-margin">
        <div class="card-panel col s12 m5">
            <h3>Informatie</h3>
            <p>
                Soort groente: <span id="current-crop"><?= $device['crop_nicename'] ?></span>
            </p>
            <p>
                <?php
                if ($crops) {
                ?>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="#" class="select-crop" data-crop="none">Geen groente</a></li>
                <?php
                foreach ($crops as $crop) {
                    ?>
                    <li><a href="#" class="select-crop" data-crop="<?= $crop['name'] ?>"><?= $crop['nicename'] ?></a></li>
                    <?php
                }
                ?>
            </ul>
            <div class="row"><button class="btn dropdown-button col s12 detail-btn" data-activates="dropdown1">Wijzig groente</button></div>
            <div class="row"><button class="btn col s12 detail-btn" id="change-name">Verander naam</button></div>
            <div class="row"><button class="btn col s12 detail-btn red darken-3" id="remove-module">Verwijder</button></div>
            <?php
            }
            ?>
        </div>
        <div class="card-panel col s12 m6 offset-m1">
            <div class="row">
                <table class="striped col s12">
                    <thead>
                    <tr>
                        <th class="center-align"><i class="fa fa-fw fa-clock-o"></i><span class="hide-on-small-only">Tijd</span></th>
                        <th class="center-align"><i class="fa fa-fw fa-thermometer-three-quarters"></i> <span class="hide-on-small-only">Temperatuur</span></th>
                        <th class="center-align"><i class="fa fa-fw fa-sun-o"></i> <span class="hide-on-small-only">Licht</span></th>
                        <th class="center-align"><i class="fa fa-fw fa-tint"></i> <span class="hide-on-small-only">Vochtigheid</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($device['data'] as $data) {
                        $timestamp = strtotime($data['timestamp']);
                        ?>
                        <tr>
                            <td class="center-align"><?= date("H:i:s", $timestamp); ?></td>
                            <td class="center-align"><?= $data['temp'] ?>&deg;C</td>
                            <td class="center-align"><?= $data['light']/10 ?>%</td>
                            <td class="center-align"><?= $data['moist']/10 ?>%</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<div class="popup-holder hidden" id="change-name-popup">
    <div class="row">
        <div class="card-panel col s12 m6 l4 offset-m3 offset-l4">
            <h3>Wijzig naam</h3>
            <form method="POST" class="col s12" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" type="text" class="validate" name="name">
                        <label for="name" id="name-label">Naam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="button" class="btn col s5" id="change-name-cancel">Annuleren</button>
                        <button type="submit" class="btn col s5 offset-s2" name="submit_name">Verander</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="popup-holder hidden" id="remove-module-popup">
    <div class="row">
        <div class="card-panel col s12 m6 l4 offset-m3 offset-l4">
            <h3>Verwijder module</h3>
            <p>
                Weet je zeker dat je de module <?= $device['name'] ?> wilt verwijderen?
            </p>
            <div class="row">
                <button class="btn col s5" id="remove-module-cancel">Annuleren</button>
                <form method="POST" action="">
                    <input type="submit" value="Verwijder" name="remove_module" class="btn col s5 offset-s2 red darken-3">
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/lib/chart.min.js"></script>
<script type="text/javascript" src="assets/js/detail.js"></script>
</body>
</html>
