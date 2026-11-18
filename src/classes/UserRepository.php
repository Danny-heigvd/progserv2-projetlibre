<?php

class UserRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un utilisateur
    public function addUser(User $user, string $password): void {
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

    // Vérifier si un pseudo ou un e-mail est déjà utilisé
    public function existe(string $pseudo, string $email): bool {
        $sql = "SELECT id_utilisateur FROM utilisateur WHERE pseudo = ? OR email = ?";

        $requete = $this->pdo->prepare($sql);
        $requete->execute([$pseudo, $email]);

        return $requete->fetch() !== false;
    }

    public function authentifier(string $email, string $password): ?User {
        $sql = "SELECT id_utilisateur, pseudo, email, mot_de_passe, points_total
                FROM utilisateur
                WHERE email = ? AND est_actif = 1";

        $requete = $this->pdo->prepare($sql);
        $requete->execute([$email]);
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);

        if ($ligne === false || !password_verify($password, $ligne['mot_de_passe'])) {
            return null;
        }

        return new User(
            $ligne['id_utilisateur'],
            $ligne['pseudo'],
            $ligne['email'],
            $ligne['points_total']
        );
    }

    public function getUsers(): array {
        $sql = "SELECT id_utilisateur, pseudo, email, points_total
            FROM utilisateur ORDER BY id_utilisateur DESC";

        $resultat = $this->pdo->query($sql);
        $users = [];

        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
                $ligne['id_utilisateur'],
                $ligne['pseudo'],
                $ligne['email'],
                $ligne['points_total']
            );
        }

        return $users;
    }

    // Supprimer un utilisateur
    public function deleteUser(int $id): void {
        $sql = "DELETE FROM utilisateur WHERE id_utilisateur = ?";

        $requete = $this->pdo->prepare($sql);
        $requete->execute([$id]);
    }
}
