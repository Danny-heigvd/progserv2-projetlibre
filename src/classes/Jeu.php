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

    public function setResume(string $resume): void {
        if (trim($resume) === '') {
            throw new InvalidArgumentException('Le résumé ne peut pas être vide.');
        }

        $this->resume = trim($resume);
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
