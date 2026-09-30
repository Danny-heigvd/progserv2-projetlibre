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

- Filtre supplémentaire dans l'encyclopédie : permettre de filtrer les jeux par
  plateforme, année ou période.

- Recherche améliorée : permettre de rechercher un jeu directement depuis une
  barre de recherche.

- Quiz personnalisé : permettre à l'utilisateur de choisir le niveau de
  difficulté avant de commencer un quiz.

- Meilleur score personnel : afficher le meilleur score de l'utilisateur pour
  chaque niveau de difficulté.

- Réinitialisation du quiz : permettre de recommencer immédiatement un quiz
  après avoir terminé une partie.

- Informations supplémentaires : ajouter quelques informations simples aux
  fiches des jeux, comme le développeur, l'éditeur ou le genre du jeu.

- Image des jeux : ajouter une image ou une jaquette à la fiche de chaque jeu.

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
