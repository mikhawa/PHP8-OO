<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Création et importation d'une classe</title>
</head>
<body>
<h1>Création et importation d'une classe</h1>
<h2>Importation</h2>
<p>Chaque classe devra se trouver dans un fichier unique, qui portera le même nom que la classe (autoload).</p>
<p>Nous allons le charger ci-dessous, (se fait en principe avant le doctype)</p>
<code>include "Personnage.php";
<?php
include "Personnage.php";
?>
<h2>Instanciation d'objets de type Personnage</h2>
<p>En OO, on instancie (création d'un objet) la classe avec le mot clef `new`</p>
<pre><code>// création de 2 instances de type Personnage contenues
// dans des alias vers la mémoire où se trouve l'objet

$perso1 = new Personnage();
$perso2 = new Personnage();

// $perso3 n'est qu'un lien symbolique vers $perso1
// il faudra utiliser le clonage pour faire une copie
// avec un nouvel espace

$perso3 = $perso1;

// affichage des personnages

var_dump($perso1,$perso2,$perso3);</code></pre>
<?php
// création de 2 instances de type Personnage contenues
// dans des alias vers la mémoire où se trouve l'objet
$perso1 = new Personnage();
$perso2 = new Personnage();

// $perso3 n'est qu'un lien symbolique vers $perso1
// il faudra utiliser le clonage pour faire une copie
// avec un nouvel espace
$perso3 = $perso1;
// affichage des personnages
var_dump($perso1,$perso2,$perso3);
?>

</body>
</html>