# ECF-garagevincentparrot

Site de présentation d'un garage automobile qui propose différents services et des véhicules en vente avec la possibilité de contacter le garage via un formulaire. 
Les horaires d'ouverture du garage sont présents sur chaque page du site (sauf dans la partie administration).
Les utilisateurs du site peuvent se créer un compte en remplissant le formulaire d'inscription (nom et prénom : minimum 2 caractères). 
Pour se connecter, les utilisateurs doivent rentrer l'adresse mail fournie lors de l'inscription ainsi que leur mot de passe contenant au minimum 8 caractères. 
Ensuite, ils peuvent laisser un avis sur le garage.
Si l'avis est validé par l'administrateur, la note de 1 à 5 apparaitra sous la forme d'étoile, avec l'avis écrit et le prénom de la personne avec la première lettre en majuscule et la première lettre de son nom de famille en majuscule.
Ils peuvent aussi modifier leurs informations personnelles ou leur mot de passe.
Les employés du garage peuvent eux aussi se créer un compte mais ils auront le rôle par défaut (Utilisateur).
Ils doivent attendre que l'administrateur du site change leur rôle.
Une fois avec le rôle Employé, ils pourront ajouter ou modifier : les horaires d'ouverture, les services du garage, des véhicules à vendre, les avis des clients qui ne souhaitent pas avoir de compte.
L'administrateur peut changer le rôle des utilisateurs du site et des employés du garage.
En fonction du rôle de l'utilisateur, la partie administration su site sera affichée dans le dropdown pour les employé(e)s et l'administrateur (cette partie du dropdown ne sera pas affichée pour les utilisateurs simples). 
Certains choix volontaires ont été décidés pour la partie administration.
Par exemple, le fait de ne pas mettre de createdAt pour les horaires du garage, les services, les voitures.
Egalement, le fait d'écrire manuellement les horaires du garage comme une chaine de caractères.
Ou encore, le fait de mettre une seule photo pour les services du garage.
- La page d'accueil : 
Présente le garage, les services d'une manière brève et expose les avis des clients.
- La page des services :
Présente plus concrètement les services proposés par le garage avec la possibilité de contacter le garage via un formulaire.
- La page des voitures :
Présente les voitures à la vente avec une photo et une description courte des véhicules.
Une pagination est faite dans le cas où il y aurait beaucoup de véhicules en ventes.
Quand on sélectionne un véhicule, il y a davantage de caractéristiques de la voiture et également plus de photos.
On peut aussi contacter le garage via un formulaire.
- La page de contact :
Permet de contacter le garage.
Dans le footer :
On trouve les horaires du garage mais aussi les coordonnées.
On peut contacter le garage via notre messagerie mail en cliquant sur l'adresse mail du garage.
On peut aussi téléphoner au garage en cliquant sur le numéro de téléphone (c'est un faux numéro).
- Administration :
Un utilisateur par défaut a été créé pour des tests avant de créer celui du futur administrateur du site.
=> Toutes les images sont des photos en libre droit.

## Utilisation

Toutes les modifications ou les suppressions se font dynamiquement (les horaires d'ouverture, les services du garage, des véhicules à vendre, les avis des clients).
Par exemple, pour l'ajout ou la suppression d'un service, la nav se met à jour automatiquement après validation.
Toujours pour les services, la partie "résumé" s'affichera automatiquement sur la page d'accueil alors que la parie "explicite" s'affichera entièrement sur la page des services.
Pareil pour les voitures, le nombre des voitures en ventes et la pagination de cette partie changent automatiquement en fonction de l'ajout ou de la suppression de véhicules.
Lorsqu'un utilisateur est connecté, quand il clique sur un bouton de contact, le formulaire s'affiche directement avec ses informations personnelles et l'objet de son mail (pour les pages services et voitures).

## Fonctionnalités

Les utilisateurs :
- créer un compte
- modifier leurs informations personnelles
- modifier leur mot de passe
- mettre un avis
- contacter

Les employés et l'administrateur :
- ajouter ou modifier les horaires d'ouverture
- ajouter ou modifier les services du garage
- ajouter ou modifier des véhicules à vendre
- ajouter ou modifier les avis des clients
- ajouter ou modifier des utilisateurs
- ajouter ou modifier des rôles d'utilisation (j'ai fait le choix de laisser la possibilité aux employés d'attribuer le rôle administrateur parce qu'il peut arriver un malheur à l'administrateur).

## Technologies utilisées

HTML, CSS, SASS, Bootstrap, Symfony (avec l'utilisation d'EasyAdmin aussi), MariaDB

## Statut du projet

Toutes les fonctionnalités du site fonctionnent correctement et l'application est claire et simple.
Même si le projet est fonctionnel, des améliorations sont prévues.
Etant un projet d'évaluation et ayant une échéance à respecter, je n'ai pas réussi à terminer tout ce que je voulais mettre en place.
- La première amélioration prévue est la mise en place des filtres pour des véhicules (peut-être en utilisant React).
Pour le moment, ils apparaissent mais ils ne fonctionnent pas et l'aspect ne me plait pas.
- La deuxième amélioration prévue est la correction du Recaptcha sur le formulaire de contact.
C'est un problème qui n'est pas en local donc il faudra faire des recherches.
- La troisième amélioration prévue est la possibilité de faire un reset du mot de passe.

## Auteur

J'ai été le seul à travailler sur ce projet.
Je remercie quand même ceux qui m'ont aidé d'une manière ou d'une autre (surtout d'une manière indirecte lors de mes recherches sur internet) lorsque j'ai rencontré des difficultés et pour stimuler ma réflexion.

## Application
En production :
https://ecf-garagevincentparrot-6c1e90f5b649.herokuapp.com/

En local :
Lancer le serveur local de Symfony dans le terminal de l'IDE et lancer le serveur pour avoir accès à la BDD et à PhpMyAdmin avec l'application installée sur sa machine.
