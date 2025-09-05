<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Création et importation d'une classe</title>
</head>
<body>
<h1>Création et importation d'une classe</h1>
<h2>Importation</h2>
<p>Chaque classe devra se trouver un fichier unique, qui portera le même nom que la classe (autoload).</p>
<p>Nous allons le charger ci-dessous, (se fait en principe avant le doctype).</p>
<code>include "Personnage.php"</code>
<?php
include "Personnage.php";
?>
<h2>Instanciation d'objets de type Personnage</h2>
<p>En OO, on instancie (création d'un objet) la classe avec le mot clef 'new'.</p>
<pre><code> // Création de 2 instances de type Personnage'
$perso1 = new Personnage();
$perso2 = new Personnage();

// Affichage des personnages
var_dump($perso1, $perso2);</code></pre>
<pre>
<?php
// Création de 2 instances de type Personnage' contenus dans des alias vers la mémoire où se trouve l'objet
$perso1 = new Personnage();
$perso2 = new Personnage();

// $perso3 n'est qu'un lien symbolique vers $perso1 il faudra utiliser le clonage pour faire une copie avec un nouvel espace
$perso3 = $perso1;
// Affichage des personnages
var_dump($perso1, $perso2);
?>
</pre>
</body><