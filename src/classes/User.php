<?php

class User {
    private ?int $id;
    private string $pseudo;
    private string $email;
    private int $pointsTotal;

    public function __construct(?int $id, string $pseudo, string $email, int $pointsTotal = 0) {
        $this->id = $id;
        $this->setPseudo($pseudo);
        $this->setEmail($email);
        $this->pointsTotal = $pointsTotal;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPointsTotal(): int {
        return $this->pointsTotal;
    }

    public function setPseudo(string $pseudo): void {
        $pseudo = trim($pseudo);

        if (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $pseudo)) {
            throw new InvalidArgumentException('Pseudo invalide (3 à 50 caractères).');
        }

        $this->pseudo = $pseudo;
    }

    public function setEmail(string $email): void {
        $email = trim($email);

        if (strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email invalide.');
        }

        $this->email = $email;
    }
}
