<?php 
require_once "config.php"; // importe toutes les classes
$role = Session::get('role'); // récupère le role de l'utilisateur, si il n'est pas connecté : null
$today = date('Y-m-d-H');
$reponse = file_get_contents("meteo/cache/$today.json");
$data = json_decode($reponse, true);
$weatherId = $data['weather'][0]['id'] ?? "na";
$sunrise = $data['sys']['sunrise'];
$sunset = $data['sys']['sunset'];
$now = time();
$isDay = ($now >= $sunrise && $now < $sunset);
$period = $isDay ? 'day' : 'night';
$weatherClass = match (true) {
  $weatherId === 800 => 'weather-sun',
  $weatherId >= 801 && $weatherId <= 804 => 'weather-cloud',
  $weatherId >= 500 && $weatherId <= 531 => 'weather-rain',
  $weatherId >= 200 && $weatherId <= 232 => 'weather-storm',
  default => 'weather-default',
};
$temps = $data['weather'][0]['description'] ?? 'Indisponible';
$temperature = round($data['main']['temp'], 0) ?? 'indisponible';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- pour que le site s'adapte aux petits écrans -->
    <title>Tentations Côtières</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Librairie FontAwesome pour tous les icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.12/css/weather-icons.min.css"> <!-- Librairie logo weather -->
    <script src="js/script.js"></script>
</head>
<body>
    <header> <!-- banière du haut du site -->
        <div class="box">
            <div id="item1">
                <img src="img/logo.png" alt="logo Camping">
            </div>
            <div id="item1-2">
                <div class="meteo">
                    <div class="weather">
                        <span class="meteo-elem"><i class="wi wi-owm-<?= $period ?>-<?= $weatherId ?> <?= $weatherClass ?>"></i></span>
                        <span class="meteo-elem"><?= $temps ?></span>
                    </div>
                    <div class="temperature">
                        Température : <?= $temperature ?> °C.
                    </div>
                </div>
            </div>
            <div id="item2">
                <h1>Tentations Côtières</h1> 
            </div>
            <div id="item3">
                <?php if(in_array($role, ['utilisateur', 'gestionnaire', 'admin'])): ?>
                    <a id=bouton_connexion href="script/logout.php">Déconnexion</a>
                <?php else: ?>
                    <a id=bouton_connexion href="login.php">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
        <div class = "menu"> <!-- barre de navigation -->
            <a class="onglet" href="index.php">Accueil</a>
            <a class="onglet" href="locations.php">Locations</a>
            <a class="onglet" href="emplacements.php">Emplacements</a>
            <a class="onglet" href="reserver.php">Réserver</a>
        </div>
    </header>
    <div class="contenu">
        <?php if(Session::get('error') !== null): ?> <!-- affichage des notifications d'erreurs -->
            <div class="alert alert-error">
                <span><?= Session::get('error') ?></span>
                <span class="alert-close" onclick="this.parentElement.style.display='none'">&times;</span>
                <?php Session::remove('error'); ?>
            </div>
        <?php endif; ?>
        <?php if(Session::get('success') !== null): ?> <!-- affichage des notifications de succès -->
            <div class="alert alert-success">
                <span><?= Session::get('success') ?></span>
                <span class="alert-close" onclick="this.parentElement.style.display='none'">&times;</span>
                <?php Session::remove('success'); ?>
            </div>
        <?php endif; ?>