<?php
require_once('Happyplants.php');
$page = new Happyplants('login');
?>
<html>
<head>
    <title>HappyPlants Login</title>
    <link type="text/css" rel="stylesheet" href="assets/css/lib/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="assets/css/main.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
</head>
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
        <div class="col s12 m6 l4 offset-m3 offset-l4 card-panel">
            <form class="col s12" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="user_name" type="text" class="validate" name="user_name">
                        <label for="user_name">Gebruikersnaam</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="user_pass" type="password" class="validate" name="user_pass">
                        <label for="user_pass">Wachtwoord</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input_field col s12">
                        <a class="btn">Registreer</a>
                        <input type="submit" class="btn right" value="Log in" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<footer class="page-footer transparent">

</footer>

<script type="text/javascript" src="assets/js/lib/jquery.js"></script>
<script type="text/javascript" src="assets/js/lib/materialize.js"></script>
</body>
</html>