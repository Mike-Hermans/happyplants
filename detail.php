<?php
if (!isset($_GET['a']))
    header("Location: index.php");
$address = urldecode($_GET['a']);

require_once('Database.php');
$db = new Database($address);
$device = $db->get_device();
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
            <a href="/" class="brand-logo left">< <?= $device['name'] ?></a>
        </div>
    </nav>
</header>
<main>
    <div class="row no-bottom-margin">
        <div class="card-panel col s12 m6">
            <table class="striped">
                <thead>
                <tr>
                    <th>Tijd</th>
                    <th>Temperatuur</th>
                    <th>Licht</th>
                    <th>Vochtigheid</th>
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
        <div class="card-panel col s12 m5 offset-m1">
            <h3>Informatie</h3>
            <p>
                Soort groente: Tomaat
            </p>
            <p>
                <button class="btn">Wijzig groente</button>
            </p>
        </div>
    </div>
</main>
<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/lib/chart.min.js"></script>
</body>
</html>
