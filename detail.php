<?php
require_once('Controllers/Happyplants.php');
$page = new Happyplants('detail');
$device = $page->device;
$crops = $page->crops;
?>
<html>
<head>
    <?php $page->get_header() ?>
</head>
<body id="detail">
<header>
    <?php $page->get_navigation($device['name']); ?>
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
                // TODO: Rebuild to form
                if ($crops) {
                ?>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="#" class="select-crop" data-crop="none">Geen groente</a></li>
                <?php
                foreach ($crops as $crop) {
                    ?>
                    <li>
                        <a href="#" class="select-crop" data-crop="<?= $crop['name'] ?>">
                            <!--<img src="assets/img/<?/*= $crop['name'] */?>.png" alt="" class="responsive-img left">-->
                            <?= $crop['nicename'] ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="row"><button class="btn dropdown-button col s12 detail-btn" data-activates="dropdown1">Wijzig groente</button></div>
            <div class="row"><button class="btn col s12 detail-btn" id="change-name">Verander naam</button></div>
            <div class="row"><button class="btn col s12 detail-btn">Aanbieden om te ruilen</button></div>
            <?php
            }
            ?>
        </div>
        <div class="card-panel col s12 m6 offset-m1 col-no-padding">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a href="#graphs"><i class="fa fa-fw fa-area-chart"></i> Grafieken</a></li>
                        <li class="tab col s3"><a href="#table"><i class="fa fa-fw fa-table"></i> Tabel</a></li>
                    </ul>
                </div>
                <div id="graphs" class="col s12">
                    <canvas id="chart"></canvas>
                </div>
                <div id="table" class="col s12">
                    <table class="striped">
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
<?php $page->get_footer(array('lib/chart', 'detail')); ?>
</body>
</html>
