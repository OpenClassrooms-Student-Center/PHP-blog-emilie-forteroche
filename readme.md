## Blog d'Emilie Forteroche

## Pour utiliser ce projet : 

- Commencer par décompresser le fichier. 
- Une fois Décompressé, créez un base de données vide appelée : "blog_forteroche" avec le user root password root
  - Importez le fichier _blog_forteroche.sql_ dans votre base de données.
  - commande :
 ```  
  mysql -u root -p blog_forteroche < blog_forteroche.sql
  ```
## Lancez le projet ! 

> Pour vous connecter en mode **admin**, il faut cliquer sur le lien en bas de page. 
>Un formulaire de connexion apparaît, le login est "Emilie" et le mot de passe est "password" (attention aux majuscules)
 

## Modifications et Explications

Suite à un problème de manipulation de git et GitHub, j'ai perdu le fork et je n'ai plus historique des modications.
Mon repository représente la version final du projet. Je vais donc détailler les différentes des changements que j'ai effectué.

1. Gestion du menu principal et ajout du sous lorsque la personne est connectée.
2. Mise à jour de la base de données pour ajout champ nbvues(int) .cela compte le nombre de vues d'un article
3. Mise à jour controleur et modéle. Ajout propriété **qteCommentaires**  
4. Modification controler Article, Ajout requete pour calculer le nombre de commentaire et de vues 
5. Gestion affichage des articles avec tri sur chaque colonne (Colonnes en plus cumuls).
   1. mise en place du framework bootstrap et fonction JS (DataTable)
   2. Il n'y aucune commande de traitements de l'information, simplement de la mise en forme graphique
   3. afin d'optimiser au mieux le site, le chargement et la mise des données se fait par des requêtes AJAX.
   4. Chaque action de tri ou suppression, sont faites par des commandes PHP.
6. Mise en place des liens vers les commentaires associés aux articles.
7. Affichages des commentaires associés à un article sous forme de tableau avec tri sur chaque colonne.
8. Mise en place Fiche modale (Bootstrap) pour confirmation de suppression pour les commentaires.
9. Modification de la confirmation sur la suppression des articles (homogénéité) 
10. Finalisation du projet avec des tests associés.


## Gestion GitHub
Le fait de faire un fork du projet , on doit attendre la validation du proprietaire pour committer les modifications.
En outre, si le propriétaire fait évoluer la branche principal, il va falloir maintenir la synchronisation.

La création d'une nouvelle sur le depôt du propriétaire par un clonage permettra simplement de faire une mise à jour simple.
On fait les commandes suivantes : 
 - on récupére URL sur le dépôt original qui est en lecture seul (pas commit possible)
 - on crée un nouvelle branche appelé **UPSTREAM**
```` - 
git remote add upstream https://github.com/OpenClassrooms-Student-Center/PHP-blog-emilie-forteroche.git
````
- on vérifie le remote a été ajouté
```
git remote -v

origin	git@github.com:belethan/BlogEmilie.git (fetch)
origin	git@github.com:belethan/BlogEmilie.git (push)
upstream	git@github.com:OpenClassrooms-Student-Center/PHP-blog-emilie-forteroche.git (fetch)
upstream	git@github.com:OpenClassrooms-Student-Center/PHP-blog-emilie-forteroche.git (push)

je vérifie mes branches
git branch -a

on constate qu'il n'y pas de branche sur upstream 

je me positionne sur la branche main et je fais un fetch pour récupérer la branche.
git fetch upstream 
```
A partir on peut récupérer les modifications sur la branche main que l'on appelle **fastforward** en faisant
une commande merge tout simplement .

```

```
## Copyright : 

Projet utilisé dans le cadre d'une formation Openclassrooms. 

            