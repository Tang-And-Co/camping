<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/class/Database.php'; // on importe la classe gérant la base de données
// on anonymise toutes les données, lorsque les utilisateurs ont supprimés leur compte, au bout de 2 ans pour respecter les RGPD mais tout de même conserver les données statistiques
Database::execute("UPDATE `user` SET nom = 'archive', prenom = 'archive', mail = CONCAT(id_user, '@archive'), tel = 'archive', mdp = 'archive' WHERE archive = 1 AND date_inscription < DATE_SUB(CURDATE(), INTERVAL 2 YEAR) AND nom != 'archive' AND prenom != 'archive';");
exit; // on arrête le script
?>