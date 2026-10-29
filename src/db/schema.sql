DROP TABLE IF EXISTS reponse_donnee;
DROP TABLE IF EXISTS tentative;
DROP TABLE IF EXISTS option_reponse;
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
    id_periode       INT AUTO_INCREMENT PRIMARY KEY,
    titre            VARCHAR(100) NOT NULL,
    description      TEXT,
    libelle_decennie VARCHAR(30),
    ordre            INT NOT NULL
);

CREATE TABLE developpeur (
    id_developpeur INT AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE plateforme (
    id_plateforme INT AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE type_element (
    id_type_element INT AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE difficulte (
    id_difficulte INT AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(50) NOT NULL UNIQUE,
    description   TEXT,
    nb_questions  INT NOT NULL,
    score_max     INT NOT NULL,
    ordre         INT NOT NULL,
    CHECK (nb_questions > 0),
    CHECK (score_max >= 0)
);

CREATE TABLE utilisateur (
    id_utilisateur   INT AUTO_INCREMENT PRIMARY KEY,
    pseudo           VARCHAR(50)  NOT NULL UNIQUE,
    email            VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe     VARCHAR(255) NOT NULL,
    est_actif        BOOLEAN   NOT NULL DEFAULT TRUE,
    date_inscription TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    points_total     INTEGER   NOT NULL DEFAULT 0
);

CREATE TABLE jeu (
    id_jeu         INT AUTO_INCREMENT PRIMARY KEY,
    titre          VARCHAR(150) NOT NULL,
    resume         TEXT,
    date_sortie    DATE,
    histoire       TEXT,
    lieu_principal VARCHAR(150),
    image_jaquette VARCHAR(255),
    est_en_vedette BOOLEAN NOT NULL DEFAULT FALSE,
    id_periode     INT NOT NULL,
    id_developpeur INT NOT NULL,
    FOREIGN KEY (id_periode) REFERENCES periode(id_periode),
    FOREIGN KEY (id_developpeur) REFERENCES developpeur(id_developpeur)
);

CREATE TABLE jeu_plateforme (
    id_jeu_plateforme INT AUTO_INCREMENT PRIMARY KEY,
    id_jeu            INT NOT NULL,
    id_plateforme     INT NOT NULL,
    UNIQUE (id_jeu, id_plateforme),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id_jeu),
    FOREIGN KEY (id_plateforme) REFERENCES plateforme(id_plateforme)
);

CREATE TABLE element (
    id_element      INT AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(150) NOT NULL,
    description     TEXT,
    image           VARCHAR(255),
    position        INT,
    id_jeu          INT NOT NULL,
    id_type_element INT NOT NULL,
    FOREIGN KEY (id_jeu) REFERENCES jeu(id_jeu),
    FOREIGN KEY (id_type_element) REFERENCES type_element(id_type_element)
);

CREATE TABLE question (
    id_question         INT AUTO_INCREMENT PRIMARY KEY,
    enonce              TEXT NOT NULL,
    explication_reponse TEXT,
    image               VARCHAR(255),
    id_jeu              INT NOT NULL,
    id_difficulte       INT NOT NULL,
    FOREIGN KEY (id_jeu) REFERENCES jeu(id_jeu),
    FOREIGN KEY (id_difficulte) REFERENCES difficulte(id_difficulte)    
);

CREATE TABLE option_reponse (
    id_option   INT AUTO_INCREMENT PRIMARY KEY,
    libelle     VARCHAR(255) NOT NULL,
    position    INT,
    est_correcte BOOLEAN NOT NULL DEFAULT FALSE,
    id_question INT NOT NULL,
    FOREIGN KEY (id_question) REFERENCES question(id_question)
);

CREATE TABLE tentative (
    id_tentative   INT AUTO_INCREMENT PRIMARY KEY,
    date_debut     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_fin       DATETIME NULL,
    id_difficulte  INT NOT NULL,
    id_utilisateur INT NOT NULL,
    CHECK (date_fin >= date_debut),
    FOREIGN KEY (id_difficulte) REFERENCES difficulte(id_difficulte),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) 
);

CREATE TABLE reponse_donnee (
    id_reponse_donnee INT AUTO_INCREMENT PRIMARY KEY,
    id_tentative      INT NOT NULL,
    id_option         INT NOT NULL,
    UNIQUE (id_tentative, id_option),
    FOREIGN KEY (id_tentative) REFERENCES tentative(id_tentative),
    FOREIGN KEY (id_option) REFERENCES option_reponse(id_option)
);
