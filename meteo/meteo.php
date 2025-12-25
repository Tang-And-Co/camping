<?php
$cacheDir = __DIR__ . '/cache/';
$today = date('Y-m-d-H'); // date et heure actuel
$cacheFile = $cacheDir . $today . '.json'; // nom du fichier
if (file_exists($cacheFile)) { // verifie si le fichier existe
    $json = file_get_contents($cacheFile);
} else {
    // supprime le contenu du dossier cache (ancien fichiers de meteo)
    foreach (glob($cacheDir . '*.json') as $file) {
        unlink($file);
    }
    $json = require __DIR__ . '/api.php'; // appel de l'API
    file_put_contents($cacheFile, $json); // sauvegarde du fichier
}
?>