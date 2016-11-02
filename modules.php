<?php
require_once('Database.php');
$db = new Database();
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
            <a href="/" class="brand-logo left">< Modules</a>
        </div>
    </nav>
</header>
<main>
    <div class="row">
        <div class="col s12 m6">
            <ul class="collection with-header" id="saved-modules">
                <li class="collection-header"><h4>Opgeslagen modules</h4></li>
                <?php
                if (count($devices) > 0) {
                    foreach ($devices as $device) {
                        ?>
                        <li class="collection-item"
                            data-address="<?= $device['address'] ?>"
                            data-name="<?= $device['name'] ?>">
                            <?= $device['name'] ?>
                            <i class="secondary-content material-icons">delete</i>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="col s12 m6" id="found-modules">

        </div>
    </div>
</main>
<footer class="page-footer transparent">
    <div class="container">
        <div class="row">
            <a class="waves-effect waves-light btn right" href="#" id="add-modules">Voeg toe</a>
        </div>
    </div>
</footer>

<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
<script type="text/javascript" src="assets/js/modules.js"></script>
</body>
</html>