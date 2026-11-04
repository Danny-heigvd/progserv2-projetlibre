
<?php

class OptionReponse {
    private int $id;
    private string $libelle;
    private bool $estCorrecte;

    public function __construct(
        int $id,
        string $libelle,
        bool $estCorrecte
    ) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->estCorrecte = $estCorrecte;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function estCorrecte(): bool {
        return $this->estCorrecte;
    }
}
