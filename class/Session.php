<?php
class Session {
    // classe gérant tout le système de session
    public static function start(): void {
        // fonction démarrant la session si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            $options = [
                'cookie_httponly' => true,
                'cookie_secure'   => isset($_SERVER['HTTPS']),
                'use_strict_mode' => true,
                'cookie_samesite' => 'Lax'
            ];
            session_start($options);
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id(true);
                $_SESSION['initiated'] = true;
            }
        }
    }
    public static function set(string $key, mixed $value): void {
        // fonction attribuant une valeur a une variable de session
        $_SESSION[$key] = $value;
    }
    public static function get(string $key): mixed {
        // fonction récupérant la valeur d'une variable de session
        return $_SESSION[$key] ?? null;
    }
    public static function remove(string $key): void {
        // fonction supprimant une variable de session
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    public static function destroy(): void {
        // fonction arretant la session si celle-ci est active
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }
    }
    public static function has(string $key): bool {
        // fonction vérifiant l'existance d'une variable de session
        return isset($_SESSION[$key]);
    }
    public static function isAuthenticated(): bool {
        // fonction vérifiant si la varible de session d'autorisation d'accès existe et contient la bonne valeur
        return self::has('access') && self::get('access') === true;
    }
}
?>