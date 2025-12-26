<?php include "integration/en-tete.php"; ?>
<?php
$today = date('Y-m-d-H');
$reponse = file_get_contents("meteo/cache/$today.json");
$data = json_decode($reponse, true);
$icon = $data['weather'][0]['icon'] ?? null;
$temps = $data['weather'][0]['description'] ?? 'Indisponible';
$temperature = round($data['main']['temp'], 0) ?? 'indisponible';
?>
<div class="accueil-container">
    <div class="meteo">
        <div class="weather">
            <img src="https://openweathermap.org/img/wn/<?= $icon ?>@2x.png"><?= $temps ?>
        </div>
        <div class="temperature">
            Température : <?= $temperature ?> °C.
        </div>
    </div>
</div>
<?php include "integration/pieds-page.html"; ?>