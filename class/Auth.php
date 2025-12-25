<?php
class Auth {
    // classe qui gère l'authentification
    private const SALT_FILE = ROOT . '/data/.salt'; // On défini une constante qui stocke le chemin du fichier de salage
    public static function checkAuth(): void {
        // fonction vérifiant si l'utilisateur est connecté
        Session::start();
        if (!Session::isAuthenticated()) {
            header('Location: /login.php', true, 302);
            exit;
        }
    }
    private static function verifyCredentials(string $mail, string $passwd): bool {
        // fonction qui vérifie si l'utilisateur est inscrit et si il a fourni le bon mot de passe
        $result = Database::query('SELECT mdp FROM `user` WHERE mail = ? AND archive = 0 LIMIT 1', [$mail]);
        if (empty($result)) {
            // si le mail n'existe pas dans la base de données
            return false;
        }
        $storedHash = $result[0]['mdp'];
        $salt = self::readSalt();
        $passwordWithSalt = $passwd . $salt;
        return password_verify($passwordWithSalt, $storedHash); // retourne true si le mot de passe est le bon
    }
    private static function readSalt(): string {
        // fonction qui lit le fichier de salage et en ressort le sel
        if (!file_exists(self::SALT_FILE)) {
            throw new RuntimeException('Fichier .salt manquant.');
        }
        $lines = file(self::SALT_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($lines)) {
            throw new RuntimeException('Fichier .salt vide ou invalide.');
        }
        return trim($lines[0]);
    }
    private static function getId(string $mail): ?int {
        // fonction qui retourne l'id de l'utilisateur connecté
        $result = Database::query('SELECT id_user FROM `user` WHERE mail = ? AND archive = 0 LIMIT 1', [$mail]);
        return $result[0]['id_user'] ?? null;
    }
    private static function getRole(string $mail): ?string {
        // fonction qui retourne le role de l'utilisateur connecté
        $result = Database::query('SELECT role FROM `user` WHERE mail = ? AND archive = 0 LIMIT 1', [$mail]);
        return $result[0]['role'] ?? null;
    }
    public static function login(string $mail, string $password): bool {
        // fonction qui gère toute la connexion
        if (self::verifyCredentials($mail, $password)) { // vérifie si la combinaison mail / mot de passe est bonne
            Session::start(); // démarre le système de session
            Session::set('access', true); // enregistre l'autorisation d'accès dans une variable de session
            Session::set('id_user', self::getId($mail)); // enregistre l'id utilisateur dans une variable de session
            Session::set('role', self::getRole($mail)); // enregistre le role de l'utilisateur dans une variable de session
            return true;
        }
        return false;
    }
    public static function verifMdp(string $pass, int $id_user): bool {
        // fonction qui vérifie le mot de passe actuel dans le cas d'un changement de mot de passe
        $result = Database::query('SELECT mdp FROM `user` WHERE id_user = ? AND archive = 0 LIMIT 1', [$id_user]);
        if (empty($result)) {
            return false;
        }
        $storedHash = $result[0]['mdp'];
        $salt = self::readSalt();
        $passwordWithSalt = $pass . $salt;
        return password_verify($passwordWithSalt, $storedHash);
    }
    public static function logout(): void {
        // fonction qui déconnecte l'utilisateur
        Session::destroy();
        Session::start();
    }
    public static function storePass(?string $mdp): ?string {
        // fonction qui hash le nouveau mot de passe dans le cas d'un changement de mot de passe
        $salt = self::readSalt();
        $passwordWithSalt = $mdp . $salt;
        return password_hash($passwordWithSalt, PASSWORD_DEFAULT);
    }
}
?>