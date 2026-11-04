<?php

class Database {
    private PDO $pdo;

    public function __construct() {
        // Configuration locale (Docker)
        $host = 'mariadb';
        $port = 3306;
        $name = 'my_database';
        $user = 'username';
        $pass = 'password';

        // Vérifier si l'application fonctionne en local
        $enLocal = in_array(
            $_SERVER['SERVER_NAME'] ?? '',
            ['localhost', '127.0.0.1'],
            true
        );

        // Sur Infomaniak, récupérer les identifiants privés
        if (!$enLocal) {

            // Emplacements possibles du fichier de configuration
            $chemins = [
                __DIR__ . '/../../config.local.php',
                __DIR__ . '/../config.local.php'
            ];

            $fichier = null;

            foreach ($chemins as $chemin) {
                if (is_file($chemin)) {
                    $fichier = $chemin;
                    break;
                }
            }

            if ($fichier === null) {
                throw new RuntimeException(
                    'Fichier de configuration introuvable'
                );
            }

            $config = require $fichier;

            $host = $config['host'];
            $name = $config['name'];
            $user = $config['user'];
            $pass = $config['pass'];
            $port = (int) ($config['port'] ?? 3306);
        }

        // Préparer la connexion MariaDB
        $dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";

        // Créer et stocker la connexion PDO
        $this->pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    /**
     * Retourne la connexion PDO.
     */
    public function getConnection(): PDO {
        return $this->pdo;
    }
}
