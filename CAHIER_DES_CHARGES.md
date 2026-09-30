# NFS Encyclopedia & Quiz

> Projet réalisé dans le cadre du cours _Programmation serveur 2 (ProgServ2)_ à
> la [HEIG-VD](https://heig-vd.ch), 2027.

Application web dédiée à la série de jeux vidéo **Need for Speed**, combinant
une encyclopédie des différents titres de la franchise et un système de quiz
permettant de tester ses connaissances.

Le but est de permettre aux visiteurs et aux utilisateurs de découvrir
l'histoire de la série Need for Speed, de consulter les différents jeux et de
tester leurs connaissances à travers des questions de difficulté croissante.

L'application proposera une interface simple permettant de naviguer entre les
différents jeux de la franchise et de participer à des quiz sur leur contenu.

## Équipe

- Danny Lopes
- Rui Monnard

## Fonctionnalités principales

- **Comptes et authentification**
  - Création d'un compte
  - Connexion et déconnexion
  - Modification de son profil
  - Gestion du mot de passe
  - Attribution d'un rôle lors de la création du compte
  - Trois rôles avec des niveaux d'accès différents :
    - **Visiteur**
    - **Utilisateur**
    - **Administrateur**

- **Gestion des accès**
  - Les **visiteurs** peuvent consulter l'encyclopédie et accéder aux
    informations publiques sur les différents jeux
  - Les **utilisateurs connectés** peuvent en plus participer aux quiz,
    enregistrer leurs scores et consulter leur historique
  - Les **administrateurs** disposent d'un accès à une section d'administration
    permettant de gérer le contenu de l'encyclopédie et les questions du quiz
  - Les pages et actions réservées à certains rôles ne sont pas accessibles aux
    autres utilisateurs

- **Section encyclopédie**
  - Présentation des différents jeux de la série Need for Speed
  - Pour chaque jeu :
    - titre
    - année de sortie
    - plateformes principales
    - brève présentation
    - informations générales sur le jeu

  - Classement chronologique des jeux
  - Recherche d'un jeu par son titre
  - Filtrage des jeux selon différents critères, notamment leur période ou leur
    sous-série
  - Consultation des fiches détaillées sans avoir besoin de créer un compte

- **Section quiz**
  - Questions permettant d'identifier dans quel jeu Need for Speed apparaît un
    élément donné
  - Questions à choix multiples
  - Plusieurs niveaux de difficulté :
    - **Facile**
    - **Moyen**
    - **Difficile**
    - **Hardcore**

  - Attribution de points en fonction de la difficulté et de la réponse
  - Affichage immédiat de la réponse après chaque question
  - Possibilité de commencer une nouvelle partie
  - Calcul du score à la fin d'un quiz
  - Enregistrement des scores des utilisateurs connectés
  - Consultation de son historique de résultats

- **Classement**
  - Classement des utilisateurs selon leurs meilleurs scores
  - Affichage du nombre de quiz réalisés et des points obtenus
  - Possibilité pour un utilisateur de consulter sa propre progression

- **Administration**
  - Gestion des jeux présents dans l'encyclopédie :
    - ajout
    - modification
    - suppression

  - Gestion des questions du quiz :
    - ajout
    - modification
    - suppression

  - Attribution du niveau de difficulté aux questions
  - Gestion des réponses possibles et de la bonne réponse
  - Consultation des utilisateurs inscrits
  - Gestion des rôles des utilisateurs

## Fonctionnalités optionnelles

À réaliser si le temps le permet, par ordre de priorité :

1. **Système de progression** : attribution d'XP aux utilisateurs en fonction de
   leurs résultats et déblocage de niveaux.
2. **Succès** : obtention de badges selon certaines performances (par exemple,
   réussir 10 quiz ou obtenir un score parfait).
3. **Quiz thématiques** : proposer des quiz consacrés à un jeu ou à une période
   précise de la série.
4. **Statistiques personnelles** : afficher le taux de réussite, le nombre de
   bonnes réponses par niveau et les jeux sur lesquels l'utilisateur est le plus
   performant.
5. **Mode défi** : proposer un quiz avec un nombre limité de vies ou de
   tentatives.
6. **Commentaires sur les réponses** : afficher une courte explication après une
   réponse afin d'apporter des informations supplémentaires sur le jeu concerné.

## Structure des données

Les principales données gérées par l'application seront notamment :

- **Utilisateurs** : informations du compte et rôle
- **Jeux** : informations relatives aux différents Need for Speed
- **Questions** : questions du quiz, niveau de difficulté et jeu concerné
- **Réponses** : réponses possibles associées aux questions
- **Résultats** : scores obtenus par les utilisateurs lors des quiz

Les données seront persistées dans une base de données afin de permettre leur
consultation et leur modification entre différentes sessions.

## Bilan de fin de projet

_À compléter en fin de projet_
