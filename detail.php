<?php
if (!isset($_GET['a']))
    header("Location: index.php");
$address = urldecode($_GET['a']);

require_once('Database.php');
$db = new Database($address);
$device = $db->get_device();
if (!$device)
    header("Location: index.php");
$crops = $db->get_crops();
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
<main data-device="<?= $device['address'] ?>">
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
            <button class="btn dropdown-button" data-activates="dropdown1">Wijzig groente</button>
            <?php
            }
            ?>
            </p>
        </div>
        <div class="card-panel col s12 m6 offset-m1">
            <table class="striped">
                <thead>
                <tr>
                    <th><i class="fa fa-fw fa-clock-o"></i><span class="hide-on-small-only">Tijd</span></th>
                    <th><i class="fa fa-fw fa-thermometer-three-quarters"></i> <span class="hide-on-small-only">Temperatuur</span></th>
                    <th><i class="fa fa-fw fa-sun-o"></i> <span class="hide-on-small-only">Licht</span></th>
                    <th><i class="fa fa-fw fa-tint"></i> <span class="hide-on-small-only">Vochtigheid</span></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($device['data'] as $data) {
                    $timestamp = strtotime($data['timestamp']);
                    ?>
                    <tr>
                        <td><?= date("H:i:s", $timestamp); ?></td>
                        <td><?= $data['temp'] ?>&deg;C</td>
                        <td><?= $data['light'] ?> L</td>
                        <td><?= $data['moist'] ?> cB</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/lib/chart.min.js"></script>
<script type="text/javascript" src="assets/js/detail.js"></script>
</body>
</html>
