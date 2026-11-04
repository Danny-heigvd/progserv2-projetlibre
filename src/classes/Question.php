<?php
class Question {
    private int $id;
    private string $enonce;
    private ?string $explication;
    private ?string $image;
    private int $idJeu;
    private int $idDifficulte;

    private array $options = [];

    public function __construct(
        int $id,
        string $enonce,
        ?string $explication,
        ?string $image,
        int $idJeu,
        int $idDifficulte
    ) {
        $this->id = $id;
        $this->enonce = $enonce;
        $this->explication = $explication;
        $this->image = $image;
        $this->idJeu = $idJeu;
        $this->idDifficulte = $idDifficulte;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEnonce(): string {
        return $this->enonce;
    }

    public function getExplication(): ?string {
        return $this->explication;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function getIdJeu(): int {
        return $this->idJeu;
    }

    public function getIdDifficulte(): int {
        return $this->idDifficulte;
    }

    public function ajouterOption(OptionReponse $option): void {
        $this->options[] = $option;
    }

    public function getOptions(): array {
        return $this->options;
    }
}
