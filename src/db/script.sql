
-- 1. Tables sans dépendance
INSERT INTO periode (titre, description, libelle_decennie, ordre) VALUES
('Les débuts', 'Naissance du jeu vidéo', '1970-1979', 1),
('L''âge d''or', 'Les consoles 8 et 16 bits', '1980-1989', 2);
 
INSERT INTO developpeur (nom) VALUES
('Nintendo'),
('Sega');
 
INSERT INTO plateforme (nom) VALUES
('NES'),
('Mega Drive');
 
INSERT INTO type_element (nom) VALUES
('Personnage'),
('Lieu');
 
INSERT INTO difficulte (nom, description, nb_questions, score_max, ordre) VALUES
('Facile', 'Questions simples', 5, 50, 1),
('Moyen', 'Questions intermédiaires', 10, 150, 2);
 
INSERT INTO utilisateur (pseudo, email, mot_de_passe) VALUES
('testeur', 'testeur@example.com', 'mot_de_passe_hache_de_test');
 
-- 2. Jeux (dépendent de periode et developpeur)
INSERT INTO jeu (titre, resume, date_sortie, histoire, lieu_principal, image_jaquette, est_en_vedette, id_periode, id_developpeur) VALUES
('Super Mario Bros', 'Un plombier sauve une princesse', '1985-09-13', 'Mario traverse le Royaume Champignon.', 'Royaume Champignon', NULL, TRUE, 2, 1),
('Sonic the Hedgehog', 'Un hérisson ultra rapide', '1991-06-23', 'Sonic affronte le Dr Robotnik.', 'Green Hill', NULL, FALSE, 2, 2);
 
-- 3. Tables qui dépendent de jeu
INSERT INTO jeu_plateforme (id_jeu, id_plateforme) VALUES
(1, 1),
(2, 2);
 
INSERT INTO element (nom, description, image, position, id_jeu, id_type_element) VALUES
('Mario', 'Le héros du jeu', NULL, 1, 1, 1),
('Royaume Champignon', 'Le monde du jeu', NULL, 2, 1, 2);
 
INSERT INTO question (enonce, explication_reponse, image, id_jeu, id_difficulte) VALUES
('Qui est le héros de Super Mario Bros ?', 'Le héros est Mario.', NULL, 1, 1),
('Comment s''appelle le méchant de Sonic ?', 'C''est le Dr Robotnik.', NULL, 2, 1);
 
-- 4. Options (dépendent de question)
INSERT INTO option_reponse (libelle, position, est_correcte, id_question) VALUES
('Mario', 1, TRUE, 1),
('Luigi', 2, FALSE, 1),
('Dr Robotnik', 1, TRUE, 2),
('Bowser', 2, FALSE, 2);
 
-- 5. Tentative (dépend de difficulte et utilisateur)
INSERT INTO tentative (date_debut, date_fin, id_difficulte, id_utilisateur) VALUES
('2026-10-30 10:00:00', '2026-10-30 10:05:00', 1, 1);
 
-- 6. Réponses données (dépendent de tentative et option_reponse)
INSERT INTO reponse_donnee (id_tentative, id_option) VALUES
(1, 1),
(1, 3);
 