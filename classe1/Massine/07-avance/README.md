# Exercice 07


## Demande

### Créez les fichiers suivants

Suivant la base de donnée, il y a `category`, on doit rajouter des fichiers dans l'espace de nom `model`

Pour le moment 1 seul contrôleur avec la variable get `c` quand on veut gérer les catégories, pas de lien entre les 2 pour le moment.

Créez 
- `CategoryMapping.php` qui est étendu de `formateur/07-avance/model/AbstractMapping.php` et qui protège les champs dans la table.
- `CategoryManager` qui est implémente `ManagerInterface` et `CrudInterface`, il faut y importer le trait `SlugifyTrait` avec use en interne