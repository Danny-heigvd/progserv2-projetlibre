<?php
require_once __DIR__ . '/../utils/autoloader.php';

$repository = new JeuRepository((new Database())->getConnection());
$jeu = $repository->findById(2);

if ($jeu === null) {
    exit('Jeu introuvable');
}

$erreur = '';

// Modifier le résumé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $resume = $_POST['resume'] ?? '';

        if (!is_string($resume)) {
            throw new InvalidArgumentException('Résumé invalide');
        }

        $jeu->setResume($resume);
        $repository->updateResume($jeu);

        header('Location: formulaire.php?ok=1');
        exit;
    } catch (InvalidArgumentException $e) {
        $erreur = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un jeu</title>
</head>

<body>

    <h1><?= htmlspecialchars($jeu->getTitre()) ?></h1>

    <form method="POST">
        <label for="resume">Modifier le résumé :</label>
        <p>
            <textarea name="resume" id="resume" rows="5" cols="50" required><?= htmlspecialchars($jeu->getResume() ?? '') ?></textarea>
        </p>
        <button type="submit">Enregistrer</button>
    </form>

    <?php if (isset($_GET['ok'])): ?>
        <p>Résumé enregistré dans MariaDB !</p>
    <?php endif; ?>

    <p><?= htmlspecialchars($erreur) ?></p>

    <h2>Résumé actuel :</h2>
    <p><?= nl2br(htmlspecialchars($jeu->getResume() ?? '')) ?></p>

</body>

</html>
