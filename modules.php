<?php
require_once('Controllers/Happyplants.php');
$page = new Happyplants('modules');
?>
<html>
<head>
    <?php $page->get_header(); ?>
</head>
<body>
<header>
    <?php $page->get_navigation('Modules'); ?>
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
<?php $page->get_footer('modules'); ?>
</body>
</html>