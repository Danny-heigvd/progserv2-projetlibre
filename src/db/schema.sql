DROP TABLE IF EXISTS reponse_donnee;
DROP TABLE IF EXISTS tentative;
DROP TABLE IF EXISTS option;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS element;
DROP TABLE IF EXISTS jeu_plateforme;
DROP TABLE IF EXISTS jeu;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS difficulte;
DROP TABLE IF EXISTS type_element;
DROP TABLE IF EXISTS plateforme;
DROP TABLE IF EXISTS developpeur;
DROP TABLE IF EXISTS periode;

CREATE TABLE periode (
    id_periode       SERIAL PRIMARY KEY,
    titre            VARCHAR(100) NOT NULL,
    description      TEXT,
    libelle_decennie VARCHAR(30),
    ordre            INTEGER NOT NULL
);

CREATE TABLE developpeur (
    id_developpeur SERIAL PRIMARY KEY,
    nom            VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE plateforme (
    id_plateforme SERIAL PRIMARY KEY,
    nom           VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE type_element (
    id_type_element SERIAL PRIMARY KEY,
    nom             VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE difficulte (
    id_difficulte SERIAL PRIMARY KEY,
    nom           VARCHAR(50) NOT NULL UNIQUE,
    description   TEXT,
    nb_questions  INTEGER NOT NULL,
    score_max     INTEGER NOT NULL,
    ordre         INTEGER NOT NULL,
    CHECK (nb_questions > 0),
    CHECK (score_max >= 0)
);

CREATE TABLE utilisateur (
    id_utilisateur   SERIAL PRIMARY KEY,
    pseudo           VARCHAR(50)  NOT NULL UNIQUE,
    email            VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe     VARCHAR(255) NOT NULL,
    est_actif        BOOLEAN   NOT NULL DEFAULT TRUE,
    date_inscription TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jeu (
    id_jeu         SERIAL PRIMARY KEY,
    titre          VARCHAR(150) NOT NULL,
    resume         TEXT,
    date_sortie    DATE,
    histoire       TEXT,
    lieu_principal VARCHAR(150),
    image_jaquette VARCHAR(255),
    est_en_vedette BOOLEAN NOT NULL DEFAULT FALSE,
    id_periode     INTEGER NOT NULL REFERENCES periode(id_periode),
    id_developpeur INTEGER NOT NULL REFERENCES developpeur(id_developpeur)
);

CREATE TABLE jeu_plateforme (
    id_jeu_plateforme SERIAL PRIMARY KEY,
    id_jeu            INTEGER NOT NULL REFERENCES jeu(id_jeu),
    id_plateforme     INTEGER NOT NULL REFERENCES plateforme(id_plateforme),
    UNIQUE (id_jeu, id_plateforme)
);

CREATE TABLE element (
    id_element      SERIAL PRIMARY KEY,
    nom             VARCHAR(150) NOT NULL,
    description     TEXT,
    image           VARCHAR(255),
    position        INTEGER,
    id_jeu          INTEGER NOT NULL REFERENCES jeu(id_jeu),
    id_type_element INTEGER NOT NULL REFERENCES type_element(id_type_element)
);

CREATE TABLE question (
    id_question         SERIAL PRIMARY KEY,
    enonce              TEXT NOT NULL,
    explication_reponse TEXT,
    image               VARCHAR(255),
    id_jeu              INTEGER NOT NULL REFERENCES jeu(id_jeu),
    id_difficulte       INTEGER NOT NULL REFERENCES difficulte(id_difficulte)
);

CREATE TABLE option (
    id_option   SERIAL PRIMARY KEY,
    libelle     VARCHAR(255) NOT NULL,
    position    INTEGER,
    est_correcte BOOLEAN NOT NULL DEFAULT FALSE,
    id_question INTEGER NOT NULL REFERENCES question(id_question)
);

CREATE TABLE tentative (
    id_tentative   SERIAL PRIMARY KEY,
    date_debut     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_fin       TIMESTAMP,
    id_difficulte  INTEGER NOT NULL REFERENCES difficulte(id_difficulte),
    id_utilisateur INTEGER NOT NULL REFERENCES utilisateur(id_utilisateur),
    CHECK (date_fin >= date_debut) 
);

CREATE TABLE reponse_donnee (
    id_reponse_donnee SERIAL PRIMARY KEY,
    id_tentative      INTEGER NOT NULL REFERENCES tentative(id_tentative),
    id_option         INTEGER NOT NULL REFERENCES option(id_option),
    UNIQUE (id_tentative, id_option)
);
