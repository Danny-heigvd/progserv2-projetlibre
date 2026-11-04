<?php

class Jeu {
    private int $id;
    private string $titre;
    private ?string $resume;
    private ?string $dateSortie;

    public function __construct(
        int $id,
        string $titre,
        ?string $resume,
        ?string $dateSortie
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->resume = $resume;
        $this->dateSortie = $dateSortie;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getResume(): ?string {
        return $this->resume;
    }

    public function getDateSortie(): ?string {
        return $this->dateSortie;
    }

    public function getAnneeSortie(): ?string {
        if ($this->dateSortie === null) {
            return null;
        }

        return substr($this->dateSortie, 0, 4);
    }
}
