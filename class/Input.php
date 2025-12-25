<?php
class Input {
    // classe vérifiant toutes les entrées utilisateur
    public static function clean(?string $data): ?string {
        // fonction évitant les injections de code
        if ($data === null) return null;
        $data = trim($data);
        $data = strip_tags($data);
        return $data === "" ? NULL : $data;
    }
    public static function mail(?string $data): ?string {
        // fontion vérifiant la validité d'une adresse mail
        if ($data === null) return null;
        $data = trim($data);
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return null;
        } else {
            return $data === "" ? NULL : $data;
        }
    }
    public static function name(?string $data): ?string {
        // fonction vérifiant la validité d'un nom ou d'un prénom
        $data = self::clean($data);
        if (strlen($data) < 2 || strlen($data) > 50) return NULL;
        if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ\- ]+$/u", $data)) return NULL;
        if ($data == 'archive') return NULL; // ce nom ou prénom ne peut pas exister car c'est un code d'anonymisation dans la table !
        return $data === "" ? NULL : ucfirst(strtolower($data));
    }
    public static function tel(?string $data): ?string {
        // fonction vérifiant la validité d'un numéro de téléphone
        $data = self::clean($data);
        $data = str_replace(' ', '', $data);
        if (!preg_match('/^\+33[1-9](?:[0-9]{2}){4}$/', $data)) {
            return NULL;
        }
        return $data === "" ? NULL : $data;
    }
    public static function pass(?string $data): ?string {
        // fonction vérifiant la validité d'un mot de passe
        $data = trim($data);
        if (strlen($data) < 8) {
            return NULL;
        }
        return $data === "" ? NULL : $data;
    }
}
?>