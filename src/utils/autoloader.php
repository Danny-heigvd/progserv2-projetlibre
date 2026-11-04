<?php

spl_autoload_register(function (string $nomClasse): void {
    $fichier = __DIR__ . '/../classes/' . $nomClasse . '.php';

    if (is_file($fichier)) {
        require_once $fichier;
    }
});
