<?php

class JeuRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function findAll(): array {
        $sql = "SELECT id_jeu, titre, resume, date_sortie
                FROM jeu
                ORDER BY date_sortie ASC, id_jeu ASC";

        $resultats = $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);

        $jeux = [];

        foreach ($resultats as $ligne) {
            $jeux[] = $this->creerJeu($ligne);
        }

        return $jeux;
    }


    public function findById(int $id): ?Jeu {
        $sql = "SELECT id_jeu, titre, resume, date_sortie
                FROM jeu
                WHERE id_jeu = :id";

        $requete = $this->pdo->prepare($sql);
        $requete->execute(['id' => $id]);

        $ligne = $requete->fetch(PDO::FETCH_ASSOC);

        if ($ligne === false) {
            return null;
        }

        return $this->creerJeu($ligne);
    }


    public function findFeatured(): ?Jeu {
        $sql = "SELECT id_jeu, titre, resume, date_sortie
                FROM jeu
                WHERE est_en_vedette = 1
                LIMIT 1";

        $ligne = $this->pdo
            ->query($sql)
            ->fetch(PDO::FETCH_ASSOC);

        if ($ligne === false) {
            return null;
        }

        return $this->creerJeu($ligne);
    }

    public function updateResume(Jeu $jeu): void {
        $sql = "UPDATE jeu SET resume = :resume WHERE id_jeu = :id";

        $requete = $this->pdo->prepare($sql);

        $requete->execute([
            'resume' => $jeu->getResume(),
            'id' => $jeu->getId()
        ]);
    }
    private function creerJeu(array $ligne): Jeu {
        return new Jeu(
            (int) $ligne['id_jeu'],
            $ligne['titre'],
            $ligne['resume'],
            $ligne['date_sortie']
        );
    }
}
