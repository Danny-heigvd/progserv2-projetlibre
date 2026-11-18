<?php
// Page « Créer un compte »
require_once __DIR__ . '/../utils/autoloader.php';

$repository = new UserRepository(
    (new Database())->getConnection()
);

$message = '';
$pseudo = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    try {
        if ($password !== $confirmation) {
            throw new InvalidArgumentException('Les deux mots de passe ne sont pas identiques.');
        }

        // User vérifie le pseudo et l'e-mail
        $user = new User(null, $pseudo, $email);

        if ($repository->existe($pseudo, $email)) {
            throw new InvalidArgumentException('Ce pseudo ou cet e-mail est déjà utilisé.');
        }

        // addUser vérifie le mot de passe, puis enregistre l'utilisateur
        $repository->addUser($user, $password);

        header('Location: connexion.php?inscription=ok');
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
    <title>Créer un compte</title>
</head>

<body>

    <h1>Créer un compte</h1>

    <p><?= htmlspecialchars($message) ?></p>

    <form method="POST">
        <input type="text" name="pseudo" placeholder="Pseudo"
            value="<?= htmlspecialchars($pseudo) ?>" required>

        <input type="email" name="email" placeholder="Email"
            value="<?= htmlspecialchars($email) ?>" required>

        <input type="password" name="password" placeholder="Mot de passe" minlength="12" required>

        <input type="password" name="confirmation" placeholder="Confirmer le mot de passe" minlength="12" required>

        <button type="submit">Créer mon compte</button>
    </form>

    <p>Déjà un compte ? <a href="connexion.php">Se connecter</a></p>

</body>

</html>
