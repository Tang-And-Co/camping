<?php
$weather = ROOT . "/data/.weather";
if (!file_exists($weather)) {
    throw new RuntimeException('Fichier .weather manquant.');
    exit;
}
$lines = file($weather, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (empty($lines) || count($lines) !== 1) {
    throw new RuntimeException('Fichier .weather vide ou invalide.');
    exit;
}
$weather_key = trim($lines[0]);
$lat = 44.604406;
$lon = -1.209074;
$url = "https://api.openweathermap.org/data/2.5/weather?" . "lat=" . $lat . "&lon=" . $lon . "&appid=" . $weather_key . "&units=metric&lang=fr";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if ($response === false) {
    throw new Exception("Erreur API OpenWeather");
}
curl_close($ch);
return $response;
?>