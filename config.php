<?php 
define('ROOT', __DIR__);
spl_autoload_register(function ($className) { // charge automatiquement toutes les classes contenu dans le dossier class
    $file = ROOT . '/class/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
Session::start(); // démarre la session si ce n'est pas déjà fait
?>
