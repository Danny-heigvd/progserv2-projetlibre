<?php
require_once __DIR__ . '/../utils/autoloader.php';

$idQuestion = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idQuestion === null) {
    $idQuestion = 1;
}

if ($idQuestion === false || $idQuestion < 1) {
    http_response_code(400);
    exit('Identifiant de question invalide.');
}

try {
    $database = new Database();

    $repository = new QuestionRepository(
        $database->getConnection()
    );

    $question = $repository->findById($idQuestion);
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('Erreur de connexion à la base de données.');
}

if ($question === null) {
    http_response_code(404);
    exit('Question introuvable.');
}
$quiz = new Quiz([$question], 1);

$resultat = null;
$score = null;
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idOption = filter_input(
        INPUT_POST,
        'option',
        FILTER_VALIDATE_INT
    );

    if ($idOption === false || $idOption === null || $idOption < 1) {
        $message = 'Sélectionne une réponse.';
    } else {

        $resultat = $quiz->verifierReponse(
            $question->getId(),
            $idOption
        );

        $score = $quiz->calculerScore([
            $question->getId() => $idOption
        ]);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Quiz NFS - Test POO</title>
</head>

<body>

    <h1>Quiz Need for Speed</h1>
    <p>Question de test</p>

    <h2>
        <?= htmlspecialchars(
            $question->getEnonce(),
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </h2>

    <form action="quiz.php?id=<?= $question->getId() ?>" method="post">

        <?php foreach ($question->getOptions() as $option): ?>

            <p>
                <label>
                    <input
                        type="radio"
                        name="option"
                        value="<?= $option->getId() ?>"
                        required>

                    <?= htmlspecialchars(
                        $option->getLibelle(),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </label>
            </p>

        <?php endforeach; ?>

        <button type="submit">
            Valider ma réponse
        </button>

    </form>
    <?php if ($message !== null): ?>
        <p>
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>
    <?php if ($resultat !== null): ?>

        <hr>

        <h2>
            <?= $resultat
                ? 'Bonne réponse !'
                : 'Mauvaise réponse.' ?>
        </h2>

        <p>
            Score du test : <?= $score ?> / 1 point
        </p>

        <p>
            <?= htmlspecialchars(
                $question->getExplication() ?? '',
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

    <?php endif; ?>

</body>

</html>
