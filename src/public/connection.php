<?php
require_once __DIR__ . '/../utils/autoloader.php';

$repository = new UserRepository(
    (new Database())->getConnection()
);

$message = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $user = $repository->authentifier($email, $password);

        if ($user === null) {
            // Même message si l'e-mail ou le mot de passe est faux
            throw new InvalidArgumentException('E-mail ou mot de passe incorrect.');
        }

        // Connexion réussie
        header('Location: index.php');
        exit;
    } catch (InvalidArgumentException $e) {
        $message = $e->getMessage();
    } catch (PDOException $e) {
        $message = 'Une erreur est survenue, veuillez réessayer plus tard.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Se connecter</title>
</head>

<body>

    <h1>Se connecter</h1>

    <?php if (isset($_GET['inscription'])): ?>
        <p>Compte créé ! Vous pouvez maintenant vous connecter.</p>
    <?php endif; ?>

    <p><?= htmlspecialchars($message) ?></p>

    <form method="POST">
        <input type="email" name="email" placeholder="Email"
            value="<?= htmlspecialchars($email) ?>" required>

        <input type="password" name="password" placeholder="Mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="user.php">Créer un compte</a></p>

</body>

</html>
