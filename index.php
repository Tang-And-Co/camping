<?php include "integration/en-tete.php"; ?>
<?php
$today = date('Y-m-d-H');
$reponse = file_get_contents("meteo/cache/$today.json");
$data = json_decode($reponse, true);
$icon = $data['weather'][0]['icon'] ?? null;
$temps = $data['weather'][0]['description'] ?? 'Indisponible';
?>
<div class="accueil-container">
    <img src="https://openweathermap.org/img/wn/<?= $icon ?>@2x.png"><?= $temps ?>
</div>
<?php include "integration/pieds-page.html"; ?>