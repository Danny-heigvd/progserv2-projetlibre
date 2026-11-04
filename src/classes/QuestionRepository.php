
<?php

class QuestionRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?Question {
        $sql = "SELECT id_question, enonce, explication_reponse, image,
                       id_jeu, id_difficulte
                FROM question
                WHERE id_question = :id";

        $requete = $this->pdo->prepare($sql);
        $requete->execute(['id' => $id]);

        $ligne = $requete->fetch(PDO::FETCH_ASSOC);

        if ($ligne === false) {
            return null;
        }

        return $this->creerQuestion($ligne);
    }

    public function findByDifficulte(int $idDifficulte): array {
        $sql = "SELECT id_question, enonce, explication_reponse, image,
                       id_jeu, id_difficulte
                FROM question
                WHERE id_difficulte = :difficulte
                ORDER BY id_question";

        $requete = $this->pdo->prepare($sql);
        $requete->execute(['difficulte' => $idDifficulte]);

        $questions = [];

        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
            $questions[] = $this->creerQuestion($ligne);
        }

        return $questions;
    }
    public function getOptions(int $idQuestion): array {
        $sql = "SELECT id_option, libelle, est_correcte
                FROM option_reponse
                WHERE id_question = :question
                ORDER BY position, id_option";

        $requete = $this->pdo->prepare($sql);
        $requete->execute(['question' => $idQuestion]);

        $options = [];

        foreach ($requete->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
            $options[] = new OptionReponse(
                (int) $ligne['id_option'],
                $ligne['libelle'],
                (bool) $ligne['est_correcte']
            );
        }

        return $options;
    }

    private function creerQuestion(array $ligne): Question {
        $question = new Question(
            (int) $ligne['id_question'],
            $ligne['enonce'],
            $ligne['explication_reponse'],
            $ligne['image'],
            (int) $ligne['id_jeu'],
            (int) $ligne['id_difficulte']
        );

        foreach ($this->getOptions($question->getId()) as $option) {
            $question->ajouterOption($option);
        }

        return $question;
    }
}
