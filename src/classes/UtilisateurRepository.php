
<?php

class UtilisateurRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un utilisateur
    public function addUser(Utilisateurs $user, string $password): void {
        if (strlen($password) < 12) {
            throw new InvalidArgumentException('Mot de passe trop court (12 caractères minimum).');
        }

        $sql = "INSERT INTO utilisateur (pseudo, email, mot_de_passe)
                VALUES (?, ?, ?)";

        $requete = $this->pdo->prepare($sql);

        $requete->execute([
            $user->getPseudo(),
            $user->getEmail(),
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    // Récupérer les utilisateurs
    public function getUsers(): array {
        $sql = "SELECT id_utilisateur, pseudo, email, points_total
                FROM utilisateur ORDER BY id_utilisateur DESC";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprimer un utilisateur
    public function deleteUser(int $id): void {
        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = ?";

        $requete = $this->pdo->prepare($sql);
        $requete->execute([$id]);
    }
}
