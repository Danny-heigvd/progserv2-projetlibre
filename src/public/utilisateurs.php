<?php
require_once __DIR__ . '/../utils/autoloader.php';

$repository = new UtilisateurRepository(
    (new Database())->getConnection()
);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        if ($_POST['action'] === 'ajouter') {
            $user = new Utilisateurs(
                null,
                $_POST['pseudo'],
                $_POST['email']
            );

            $repository->addUser($user, $_POST['password']);
            $message = 'Utilisateur ajouté !';
        }

        // Supprimer un utilisateur
        if ($_POST['action'] === 'supprimer') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            if (!$id) {
                throw new InvalidArgumentException('ID invalide.');
            }

            $repository->deleteUser($id);
            $message = 'Utilisateur supprimé !';
        }
    } catch (InvalidArgumentException $e) {
        $message = $e->getMessage();
    } catch (PDOException $e) {
        $message = 'Erreur : pseudo ou email déjà utilisé, ou suppression impossible.';
    }
}

$users = $repository->getUsers();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Utilisateurs</title>
</head>

<body>

    <h1>Gestion des utilisateurs</h1>

    <h2>Ajouter un utilisateur</h2>

    <form method="POST">
        <input type="hidden" name="action" value="ajouter">

        <input type="text" name="pseudo" placeholder="Pseudo" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" minlength="12" required>

        <button type="submit">Ajouter</button>
    </form>

    <p><?= htmlspecialchars($message) ?></p>

    <h2>Liste des utilisateurs</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Points</th>
            <th>Action</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id_utilisateur'] ?></td>
                <td><?= htmlspecialchars($user['pseudo']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['points_total'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="<?= $user['id_utilisateur'] ?>">

                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>
