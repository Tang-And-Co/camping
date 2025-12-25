<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/class/Database.php'; // on importe la classe gérant la base de données
// on sauvegarde toutes les tables dans un fichier sql
$tables = ["user", "reservation"]; // les différentes tables à sauvegarder
$return = ''; // variable qui contiendra l'entièreté du code sql
foreach ($tables as $table) { // pour chaque table on la supprime si elle existe, on la créé et on y insert les données
    $return .= "DROP TABLE IF EXISTS `$table`;\n\n";
    $return .= Database::query("SHOW CREATE TABLE " . $table)[0]['Create Table'] . ";\n\n";
    $rows = Database::query("SELECT * FROM `$table`");
    foreach ($rows as $row) {
        $columns = array_map(fn($col) => "`$col`", array_keys($row));
        $values = array_map(function($val) {
            if ($val === null) return "NULL";
            return "'" . addslashes($val) . "'";
        }, array_values($row));
        $return .= "INSERT INTO `$table` (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ");\n";
    }
    $return .= "\n\n";
}
// on rajoute l'évènement d'anonymisation
$return .= "
CREATE EVENT IF NOT EXISTS anonym
ON SCHEDULE
    EVERY 1 DAY
    STARTS TIMESTAMP(
        CURRENT_DATE + INTERVAL 1 DAY,
        '02:30:00'
    )
DO
UPDATE `user`
SET
    nom = 'archive',
    prenom = 'archive',
    mail = CONCAT(id_user, '@archive'),
    tel = 'archive',
    mdp = 'archive'
WHERE
    archive = 1
    AND date_inscription < DATE_SUB(CURDATE(), INTERVAL 2 YEAR)
    AND nom != 'archive'
    AND prenom != 'archive';
";
$filename = ROOT . '/auto/backup/backup_' . date('Y-m-d_H-i-s') . '.sql'; // on défini le chemin du fichier
file_put_contents($filename, $return); // on enregistre le fichier contenant tout le code
exit; // on arrête le script
?>