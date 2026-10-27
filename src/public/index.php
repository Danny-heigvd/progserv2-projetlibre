<?php
const DB_HOST = 'mariadb';
const DB_PORT = 3306;
const DB_NAME = 'my_database';
const DB_USER = 'username';
const DB_PASSWORD = 'password';

$host = DB_HOST;
$name = DB_NAME;
$user = DB_USER;
$pass = DB_PASSWORD;

// En ligne (pas sur localhost) : on prend les identifiants d'Infomaniak
$enLocal = in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1']);
$fichier = __DIR__ . '/../config.local.php';

if (!$enLocal && file_exists($fichier)) {
    $config = require $fichier;
    $host = $config['host'];
    $name = $config['name'];
    $user = $config['user'];
    $pass = $config['pass'];
}

$dsn = "mysql:host=" . $host . ";port=" . DB_PORT . ";dbname=" . $name . ";charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit($enLocal ? 'Erreur BDD : ' . htmlspecialchars($e->getMessage()) : 'Erreur BDD');
}

$sql = "SHOW TABLES";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProgServ2 Course PHP Template</title>
</head>

<body>
    <h1>ProgServ2 Course PHP Template</h1>

    <p>Bienvenue dans votre projet PHP pour le cours ProgServ2 à la HEIG-VD !</p>

    <h2>Résultats de la base de données :</h2>

    <ul>
        <?php foreach ($results as $row) { ?>
            <li><?= htmlspecialchars($row) ?></li>
        <?php } ?>
    </ul>
</body>

</html>
