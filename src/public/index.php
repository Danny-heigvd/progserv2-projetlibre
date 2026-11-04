<?php
require_once __DIR__ . '/../utils/autoload.php';

try {
    $database = new Database();
    $pdo = $database->getConnection();

    $tables = $pdo->query("SHOW TABLES")
        ->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException | RuntimeException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Erreur BDD');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFS Archive</title>
</head>

<body>
    <h1>NFS Archive</h1>

    <p>Bienvenue dans notre projet PHP pour le cours ProgServ2 à la HEIG-VD !</p>

    <h2>Résultats de la base de données :</h2>

    <?php foreach ($tables as $table) { ?>
        <?php if ($table === 'utilisateur') continue; ?>

        <h2><?= htmlspecialchars($table) ?></h2>

        <?php $lignes = $pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC); ?>

        <?php if (empty($lignes)) { ?>
            <p>Table vide</p>
        <?php } else { ?>
            <table border="1">
                <tr>
                    <?php foreach (array_keys($lignes[0]) as $colonne) { ?>
                        <th><?= htmlspecialchars($colonne) ?></th>
                    <?php } ?>
                </tr>
                <?php foreach ($lignes as $ligne) { ?>
                    <tr>
                        <?php foreach ($ligne as $valeur) { ?>
                            <td><?= htmlspecialchars($valeur ?? '') ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    <?php } ?>
</body>

</html>
