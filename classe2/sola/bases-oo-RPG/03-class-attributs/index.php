<?php
// déclaration stricte
declare(strict_types=1);

include "Personnage.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les attributs protected et private dans une classe</title>
</head>
<body>
<h1>Les attributs protected et private dans une classe</h1>
<h2>Ce sont les "variables" internes de la classe, non modifiables depuis l'extérieur</h2>

<h2>Instanciation d'objets de type Personnage</h2>
<p>En OO, on instancie (création d'un objet) la classe avec le mot clef `new`</p>
<pre><code>// création de 2 instances de type Personnage contenues
// dans des alias vers la mémoire où se trouve l'objet

$perso1 = new Personnage();
$perso2 = new Personnage();
$perso3 = new Personnage();

// affichage des personnages

var_dump($perso1,$perso2,$perso3);</pre>
<?php
// création de 2 instances de type Personnage contenues
// dans des alias vers la mémoire où se trouve l'objet
$perso1 = new Personnage();
$perso2 = new Personnage();
$perso3 = new Personnage();

// affichage des personnages
var_dump($perso1,$perso2,$perso3);
?>

<h2>La visibilité privée et protégée des attributs</h2>
<p>Ces attributs ne peuvent être écrites ni lues en dehors de la classe. Pour cela, nous devons utiliser des getters et setters, qui sont des méthodes `public` (fonctions publiques de la classe). </p>

<h3>La différence entre l'attribut private et protected est que le private ne peut être modifié que DANS la classe actuelle, le protected peut être modifié dans les enfants (extends voir tard).</h3>

<h3>Modification d'un attribut private ou protected</h3>
<h4>Ces attributs ne sont pas modifiables depuis l'extérieur de la classe</h4>
<code>Ces codes ne fonctionneront pas</code>
<pre><code>$perso1->genre = "Masculin";
$perso1->age=7;
$perso1->mois = null;

$perso2->genre = "Féminin";
$perso2->age=20;
$perso2->mois = "Janvier";

$perso3->genre = "Non genré";
$perso3->age=35;
$perso3->mois = 8;</code></pre>

<h3>Affichage d'un attribut private ou protected</h3>
<h4>Ces attributs ne sont pas affichables depuis l'extérieur de la classe</h4>
<code>Ces codes ne fonctionneront pas</code>
<pre><code>echo '$perso1 : '." Genre : {$perso1->genre} | Age : {$perso1->age} | Mois : {$perso1->mois}&lt;br&gt;";
echo '$perso2 : '." Genre : {$perso2->genre} | Age : {$perso2->age} | Mois : {$perso2->mois}&lt;br&gt;";
echo '$perso3 : '." Genre : {$perso3->genre} | Age : {$perso3->age} | Mois : {$perso3->mois}&lt;br&gt;";</code></pre>

<h3>On doit utiliser des méthodes publiques pour modifier ces attributs</h3>
<p>Méthode publique bateau 1 : initializePersonnage()</p>
<code>$perso1->initializePersonnage();
var_dump($perso1);</code>
<?php
$perso1->initializePersonnage();
var_dump($perso1);
?>
<p>Méthode publique bateau 2 : public function initializeLazyPersonnage(string $leGenre, int $lAge, null|string|int $leMois):void
Cette fonction ne vérifie que le type, mais permet de changer les 3 attributs</p>
<pre><code>
$perso2->initializeLazyPersonnage("lala",-7,null);
$perso3->initializeLazyPersonnage(" ",3000,"Quindécembre");
var_dump($perso2,$perso3);
    </code></pre>
<?php
$perso2->initializeLazyPersonnage("lala",-7,null);
$perso3->initializeLazyPersonnage(" ",3000,"Quindécembre");
var_dump($perso2,$perso3);
?>

<p>Méthode publique bateau 3 : public function initializeTruePersonnage(string $leGenre, int $lAge, null|string|int $leMois):void
Cette fonction vérifie plus que le type, permet de changer les 3 attributs, mais n'est pas assez précise (getters and setters)</p>
<pre><code>
$perso4 = new Personnage();
$perso5 = new Personnage();
$perso2->initializeTruePersonnage("Masculin",20,null);
$perso3->initializeTruePersonnage(" ",3000,"Quindécembre");
var_dump($perso2,$perso3);
    </code></pre>
<?php
$perso4 = new Personnage();
$perso5 = new Personnage();
$perso4->initializeTruePersonnage("Masculin",20,null);
$perso5->initializeTruePersonnage(" ",3000,"Quindécembre");
var_dump($perso4,$perso5);
?>
<h1>suivant getters and setters</h1>
</body>
</html>
 </code>