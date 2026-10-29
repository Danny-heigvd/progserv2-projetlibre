-- 1. Tables sans dépendance
INSERT INTO periode (titre, description, libelle_decennie, ordre) VALUES
('Les origines', 'Là où tout commence : routes ouvertes, voitures d''exception et premières poursuites policières.', 'Années 1990', 1),
('L''âge d''or', 'La décennie culte qui impose le tuning, les courses nocturnes et les poursuites spectaculaires.', 'Années 2000', 2),
('La réinvention', 'Entre retours aux sources et nouvelles expériences, la saga explore une identité plus cinématographique.', 'Années 2010', 3),
('L''âge moderne', 'Une nouvelle génération portée par un style visuel audacieux et une culture automobile sans frontières.', 'Années 2020', 4);
 
INSERT INTO developpeur (nom) VALUES
('EA Canada'),
('EA Black Box');
 
INSERT INTO plateforme (nom) VALUES
('3DS'),
('PC'),
('PS1'),
('PS2');
 
INSERT INTO type_element (nom) VALUES
('Voiture'),
('Personnage');
 
INSERT INTO difficulte (nom, description, nb_questions, score_max, ordre) VALUES
('Facile', 'Des questions accessibles sur les jeux les plus connus, leurs villes et leurs voitures emblématiques.', 3, 100, 1),
('Moyen', 'Un niveau pour les habitués de la saga, avec des questions sur les personnages, les studios et les périodes.', 5, 250, 2),
('Difficile', 'Des détails plus précis sur les scénarios, les modèles de voitures, les lieux et les mécaniques de jeu.', 8, 500, 3),
('Hardcore', 'Le défi ultime : dates exactes, éditions particulières et références réservées aux véritables spécialistes.', 10, 1000, 4);
 
-- Faux compte de test. Le mot de passe n'est pas un vrai hash : il sera remplacé
-- par un hash créé avec password_hash() quand l'inscription sera codée.
INSERT INTO utilisateur (pseudo, email, mot_de_passe, points_total) VALUES
('racer_test', 'racer.test@example.com', 'HASH_DE_TEST_A_REMPLACER', 50);
 
-- 2. Jeux (dépendent de periode et developpeur)
INSERT INTO jeu (titre, resume, date_sortie, histoire, lieu_principal, image_jaquette, est_en_vedette, id_periode, id_developpeur) VALUES
('The Need for Speed', 'Premier chapitre de la saga, réalisé avec le magazine Road & Track pour retranscrire fidèlement les sensations et le son de voitures d''exception.', '1994-08-31', 'Lamborghini Diablo VT s''impose comme la voiture-signature de cet épisode.', 'Routes ouvertes inspirées de lieux réels', NULL, FALSE, 1, 1),
('Need for Speed: Most Wanted', 'Most Wanted fusionne tuning, monde ouvert et poursuites policières dans une campagne devenue emblématique de la franchise.', '2005-11-15', 'Grimpez la Blacklist et échappez aux poursuites les plus intenses de Rockport.', 'Rockport', NULL, TRUE, 2, 2);
 
-- 3. Tables qui dépendent de jeu
INSERT INTO jeu_plateforme (id_jeu, id_plateforme) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 4);
 
INSERT INTO element (nom, description, image, position, id_jeu, id_type_element) VALUES
('Lamborghini Diablo VT', 'La voiture la plus iconique de cet épisode.', NULL, 1, 1, 1),
('Le pilote', 'L''une des figures les plus reconnaissables du jeu.', NULL, 1, 1, 2),
('BMW M3 GTR', 'La voiture emblématique du joueur dans Most Wanted.', NULL, 1, 2, 1);
 
INSERT INTO question (enonce, explication_reponse, image, id_jeu, id_difficulte) VALUES
('Quel personnage vole la BMW M3 GTR du joueur au début de Most Wanted ?', 'Razor sabote puis remporte la BMW du joueur avant de prendre la tête de la Blacklist.', NULL, 2, 2);
 
-- 4. Options (dépendent de question)
INSERT INTO option_reponse (libelle, position, est_correcte, id_question) VALUES
('Darius', 1, FALSE, 1),
('Cross', 2, FALSE, 1),
('Razor', 3, TRUE, 1),
('Eddie', 4, FALSE, 1);
 
-- 5. Tentative (dépend de difficulte et utilisateur) : un quiz Moyen
INSERT INTO tentative (date_debut, date_fin, id_difficulte, id_utilisateur) VALUES
('2026-10-29 20:00:00', '2026-10-29 20:03:00', 2, 1);
 
-- 6. Réponse donnée (dépend de tentative et option_reponse) : l'utilisateur a choisi Darius
INSERT INTO reponse_donnee (id_tentative, id_option) VALUES
(1, 1);
 