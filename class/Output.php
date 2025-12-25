<?php
class Output {
    // classe gérant tout l'affichage
    public static function printTel(string $tel): string {
        // fonction formattant un numéro de téléphone pour affichage
        return substr($tel, 0, 3) . ' ' . substr($tel, 3, 1) . ' ' . substr($tel, 4, 2) . ' ' . substr($tel, 6, 2) . ' ' . substr($tel, 8, 2) . ' ' . substr($tel, 10, 2);
    }
}
?>