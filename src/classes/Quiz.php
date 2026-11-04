
<?php

class Quiz {
    private array $questions;
    private int $scoreMax;

    public function __construct(array $questions, int $scoreMax) {
        if (count($questions) === 0 || $scoreMax < 0) {
            throw new InvalidArgumentException('Quiz invalide.');
        }

        $this->questions = $questions;
        $this->scoreMax = $scoreMax;
    }

    public function getNombreQuestions(): int {
        return count($this->questions);
    }

    public function verifierReponse(
        int $idQuestion,
        int $idOption
    ): bool {
        foreach ($this->questions as $question) {

            if ($question->getId() !== $idQuestion) {
                continue;
            }

            foreach ($question->getOptions() as $option) {
                if ($option->getId() === $idOption) {
                    return $option->estCorrecte();
                }
            }
        }

        return false;
    }
    public function calculerScore(array $reponses): int {
        $bonnesReponses = 0;

        foreach ($this->questions as $question) {
            $idOption = $reponses[$question->getId()] ?? null;

            if (
                is_int($idOption) &&
                $this->verifierReponse($question->getId(), $idOption)
            ) {
                $bonnesReponses++;
            }
        }

        return (int) round(
            $bonnesReponses / count($this->questions)
                * $this->scoreMax
        );
    }
}
