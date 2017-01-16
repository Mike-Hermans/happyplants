<?php
require_once('Controllers/Happyplants.php');
$page = new Happyplants('index');
?>
<html>
<head>
    <?php $page->get_header() ?>
</head>
<body id="index">
<header>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo left">Happyplants</a>
            <ul class="right">
                <li>
                    <a href="/modules">
                        <i class="fa fa-fw fa-2x fa-cogs mobilefix"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="row no-bottom-margin">
        <div class="col s12 m6 l3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">
                        <i class="fa fa-fw fa-balance-scale"></i>
                        Markt
                    </span>
                    <div class="row no-bottom-margin">
                        <p class="flow-text">
                            Op de markt kun je jouw groente ruilen voor groenten van anderen.
                        </p>
                        <br>
                        <a href="/market" class="btn col s12">
                            Bekijk de markt
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($page->has_devices()) {
            foreach ($page->devices as $device) {
                ?>
                <div class="col s12 m6 l3">
                    <div class="card"
                         data-name="<?= $device['name'] ?>"
                         data-address="<?= $device['address'] ?>">
                        <div class="card-content">
                            <span class="card-title"><?= $device['name'] ?></span>
                            <div class="row valign-wrapper">
                                <div class="col s6 right-padding-only">
                                    <?php if (count($device['data']) > 0) {
                                        ?>
                                        <ul class="collection">
                                            <li class="collection-item"><i class="fa fa-fw fa-thermometer-three-quarters"></i> <?= $device['data']['temp'] ?>&deg;C</li>
                                            <li class="collection-item"><i class="fa fa-fw fa-sun-o"></i> <?= $device['data']['moist'] / 10 ?>%</li>
                                            <li class="collection-item"><i class="fa fa-fw fa-tint"></i> <?= $device['data']['light'] / 10?>%</li>
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
                                <div class="col s6 left-padding-only">
                                    <div class="card-panel">
                                        <img src="assets/img/<?= $device['crop'] ?>.png" alt="<?= $device['crop'] ?>" class="responsive-img">
                                    </div>
                                </div>
                            </div>
                            <div class="row no-bottom-margin">
                                <a href="/detail?a=<?= urlencode($device['address']) ?>" class="btn col s12">
                                    Meer gegevens
                                </a>
                            </div>
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
<?php $page->get_footer('index'); ?>
</body>
</html>