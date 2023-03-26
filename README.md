# movie-time

## Projet _Dans movie'time

## Description du projet

Un client veut créer un site référencemment de films et séries, en l'occurence un journal de films et séries.  
Le site va probablement s'appeller movie'time , mais le nom de code du projet est pour l'instant : **movie**.

## Brief client

### Sur toutes les pages

En bas de chaque page, il y aura :

- le nom de la boutique
- les liens vers les pages de la boutique sur les réseaux sociaux
- un switcher de théme
- la mise en avant du fait que livraison et retours sont gratuits, que les clients ont 30 jours pour renvoyer leur produit, que les internautes peuvent contacter notre service client au 01 02 03 04 05 de 8h à 19h, du lundi au vendredi
- un formulaire d'inscription à la newsletter

### Catalogue

Voici le contenu du site prévu pour l'instant :

- une page d'accueil (avec une liste de 5 film et séries, avec une description succincte, le titre le rating )
- une page par film ou série (avec une description détailléé , le rating , les acteurs et leur role dans d'autre film, le dernier commentaire, le nombre de saison , la saison actuelle, la durée, le genre)
- sur chaque page produit (la possibilité d'être redirigé vers une page d'ajout d'un commnetaire sans être connecté)

### BackOffice

Zone réservée aux administrateurs _business_ et techniques du site.

- l'accès à cette zone nécessite de se connecter avec son compte
- les échanges entre le navigateur et le serveur Web sont chiffrés par soucis de confidentialité & sécurité
- gestion des films (liste, ajout, modification, suppression)
- gestion des séries (liste, ajout, modification, suppression)
- gestion des genre (liste, ajout, modification, suppression)
- gestion des acteurs (liste, ajout, modification, suppression)
- gestion des utilisateurs du BackOffice
- 2 types d'utilisateurs :
  - `catalog manager` pouvant gérer les données sur les films er séries.
  - `admin` pouvant, en plus de ce que peut faire un `catalog manager`, gérer les utilisateurs du backoffice et en créer, supprimer et créer des film et séries

## Documents techniques

- [User stories]
- [Product backlog]
- [Intégration HTML/CSS]

## Organisation

L'organisation pour le développement du site est horizontale, et suit la méthode agile _Scrum_ (développement itératif par _Sprints_).

Il y a des rôles prédéfinis. Quel que soit son rôle, on ne donne d'ordre à personne : chaque personne qui assume un rôle s'occupe de sa partie, de ses responsabilités, en locurrence pour ce projet de présentation j'ai endossé les rôles .

### Product Owner

Le Product Owner est l'unique rédacteur du _Product Backlog_.  

### Scrum Master

### Developer

### Sprints

Chaque _Sprint_ va durer une "un mois", soit 17 jours.

À la fin de chaque _Sprint_ sera livré un _Incrément_ du projet, contenant les fonctionnalités mises en place pendant ce _Sprint_ (_Sprint Backlog_).

### Daily Scrum

Chaque début de journée, les _Developers_ organisent un _Daily Scrum_ "lite" (léger) afin de savoir :

- ce que chacun a fait la veille
- ce que chacun compte faire aujourd'hui
- ce qui nous bloque, si quelque chose nous bloque

## Versions du projet

Le logiciel de versionning pour ce projet sera _Git_.

## Documentation

La documentation technique devra être rédigée **en anglais**.