<?php

require_once __DIR__ . '/../utils/autoloader.php';

try {
    // Connexion à MariaDB
    $database = new Database();
    $pdo = $database->getConnection();

    // Récupération des jeux
    $jeuRepository = new JeuRepository($pdo);
    $jeux = $jeuRepository->findAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Impossible de récupérer les jeux.');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Encyclopédie NFS</title>
</head>

<body>

    <h1>Encyclopédie Need for Speed</h1>

    <h2>Liste des jeux</h2>

    <?php foreach ($jeux as $jeu): ?>

        <article>
            <h3>
                <?= htmlspecialchars($jeu->getTitre(), ENT_QUOTES, 'UTF-8') ?>
            </h3>

            <p>
                Année :
                <?= htmlspecialchars($jeu->getAnneeSortie() ?? 'Inconnue') ?>
            </p>

            <p>
                <?= htmlspecialchars($jeu->getResume() ?? 'Aucun résumé', ENT_QUOTES, 'UTF-8') ?>
            </p>

            <a href="jeu.php?id=<?= $jeu->getId() ?>">
                Découvrir le jeu
            </a>
        </article>

        <hr>

    <?php endforeach; ?>

</body>

</html>
