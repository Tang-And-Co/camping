<?php
class Database {
    // classe qui gère la connexion avec la base de données
    private const DB_FILE = ROOT . '/data/.dbfile'; // On défini une constante qui stocke le chemin du fichier de connexion à la base de donnée
    private static ?mysqli $conn = null; // On initialise une constante qui stocke l'état de la connexion à la base de données
    private static function extract(): array {
        // fonction qui extrait les informations contenues dans le fichier de connexion à la base de données
        if(!file_exists(self::DB_FILE)) {
            throw new RuntimeException('Fichier de configuration manquant.');
        }
        $lines = file(self::DB_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (count($lines) !== 4) {
            throw new RuntimeException('Fichier de configuration invalide.');
        }
        [$host, $user, $pass, $db] = array_map('trim', $lines);
        return [$host, $user, $pass, $db];
    }
    private static function connect(): mysqli {
        // fonction qui ouvre une connexion avec la base de données si celle-ci n'est pas déjà active
        if (self::$conn === null) {
            [$host, $user, $pass, $db] = self::extract();
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            try {
                self::$conn = new mysqli($host, $user, $pass, $db);
                self::$conn->set_charset('utf8mb4');
            } catch (mysqli_sql_exception $e) {
                throw new RuntimeException('Erreur de connexion DB : ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
    public static function execute(string $query, array $params = []): bool {
        // fonction qui execute une instruction sql
        $conn = self::connect(); // on vérifie l'état de la connexion
        $stmt = $conn->prepare($query); // on prépare la requête
        if (!$stmt) {
            throw new RuntimeException('Préparation échouée : ' . $conn->error);
        }
        if (!empty($params)) {
            $types = self::getParamTypes($params); // on récupère le type des paramètres à ajouter
            $stmt->bind_param($types, ...$params); // on finalise la préparation de la requête en y ajoutant la valeur des paramètres
        }
        $stmt->execute(); // on envoi la requête à la base de données
        $stmt->close();
        return true;
    }
    public static function query(string $query, array $params = []): array {
        // fonction qui execute une instruction sql et en retourne le résultat
        $conn = self::connect(); // on vérifie l'état de la connexion
        $stmt = $conn->prepare($query); // on prépare la requête
        if (!$stmt) {
            throw new RuntimeException('Préparation échouée : ' . $conn->error);
        }
        if (!empty($params)) {
            $types = self::getParamTypes($params); // on récupère le type des paramètres à ajouter
            $stmt->bind_param($types, ...$params); // on finalise la préparation de la requête en y ajoutant la valeur des paramètres
        }
        $stmt->execute(); // on envoi la requête à la base de données
        $result = $stmt->get_result(); // on récupère le résultat de la requête
        $data = $result->fetch_all(MYSQLI_ASSOC); // on créé un tableau contenant le résultat
        $stmt->close();
        return $data; // on retourne le tableau créé
    }
    private static function getParamTypes(array $params): string {
        // fonction qui associe un paramètre à son type
        $types = '';
        foreach ($params as $param) {
            $types .= match (gettype($param)) {
                'integer' => 'i',
                'double'  => 'd',
                'string'  => 's',
                default   => 'b',
            };
        }
        return $types;
    }
    public static function lastInsertId(): int {
        // fonction qui récupère le dernier id inséré dans la base de données
        $conn = self::connect();
        return $conn->insert_id;
    }
}
?>