<?php

require_once __DIR__ . '/../utils/autoloader.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id < 1) {
    http_response_code(400);
    exit('Identifiant de jeu invalide.');
}

try {
    $database = new Database();
    $jeuRepository = new JeuRepository(
        $database->getConnection()
    );

    $jeu = $jeuRepository->findById($id);
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Erreur lors du chargement du jeu.');
}

if ($jeu === null) {
    http_response_code(404);
    exit('Jeu introuvable.');
}

?>

<h1><?= htmlspecialchars($jeu->getTitre(), ENT_QUOTES, 'UTF-8') ?></h1>

<p>
    Année :
    <?= htmlspecialchars($jeu->getAnneeSortie() ?? 'Inconnue') ?>
</p>

<p>
    <?= htmlspecialchars($jeu->getResume() ?? 'Aucun résumé', ENT_QUOTES, 'UTF-8') ?>
</p>
