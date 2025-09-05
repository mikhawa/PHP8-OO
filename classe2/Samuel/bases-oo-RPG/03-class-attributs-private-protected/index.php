<?php

// Déclaration du mode strict
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
<h2>Ce sont les "variables" interne de la classe, non modifiable de l'extérieur</h2>
<p></p>


<h2>Instanciation d'objet de type Personnage:</h2>
<p>En OO, on instancie (création d'un objet) la classe avec le mot clef `new`.</p>
<pre><code>// création de 2 instances de type Personnage
    $perso1 = new Personnage();
    $perso2 = new Personnage();
    $perso3 = new Personnage();

// affichage des Personnages
var_dump($perso1, $perso2);</code></pre>

<?php
// création de 2 instances de type Personnage
// dans des alias vers la mémoire :ù sont stockées les instances
$perso1 = new Personnage();
$perso2 = new Personnage();
$perso3 = new Personnage();

// affichage des Personnages
var_dump($perso1, $perso2, $perso3);
?>

<h2>La visibilité privée et protégée des attributs :</h2>
<p>Ces attributs ne peuvent être écrites ni lues en dehors de la classe. Pour cela, nous devons utiliser des getters et setters, qui sont des méthodes `public`
    (fonctions publiques de la classe).</p>

<h3>La différence entre l'attribut private et protected est que le private ne peut être modifié que DANS la classe actuelle, le protected peut être modifié
    dans les enfants (extends voir plus tard)</h3>

<h3>Modification d'un attribut private ou protected</h3>
<h4>Ces attributs ne sont modifiables depuis l'extérieur de la classe</h4>
<p>avec le signe echo instance-> attribut</p>

<pre>
<code>
$perso1->genre = "Masculin";
$perso1->age = 7;
$perso1->mois= null;


$perso2->genre = "Feminin";
$perso2->age = 12;
$perso2->mois = "Janvier";


$perso3->genre = "Féminin";
$perso3->age = 20;
$perso3->mois = 8;

var_dump($perso1, $perso2, $perso3);
</code>
</pre>

<h3>Affichage d'un attribut private ou protected:</h3>
<h4>Ces attributs ne sont modifiables depuis l'extérieur de la classe</h4>
<p>Ces codes ne fonctionneront pas :</p>

<pre>
<code>
echo '$perso1 : '. "Genre :{$perso1->genre} | Age :{$perso1->age} ans, Mois :{$perso1->mois}";
echo '$perso2 : '. "Genre :{$perso2->genre} | Age :{$perso2->age} ans, Mois :{$perso2->mois}";
echo '$perso3 : '. "Genre :{$perso3->genre} | Age :{$perso3->age} ans, Mois :{$perso3->mois}";
</code>
</pre>

<h3>On doit utiliser des méthodes publiques pour modifier ces attributs</h3>
<p>Méthode publique bateau 1 : initializePersonnage()</p>
<pre><code>$perso1->initializePersonnage();
    var_dump($perso1);</code></pre>
<pre>
    <?php
        $perso1->initializePersonnage();
        var_dump($perso1);
    ?>
</pre>

<p>Méthode publique bateau 2 : initializeLazyPersonnage()<br>Cette fonction ne vérifie que le type, mais permet
    de changer les 3 attributs</p>
<pre><code>public function initializeLazyPersonnage(string $leGenre, int $lAge, null|int|string $leMois) : void
    var_dump($perso1);</code></pre>
<pre><code>$perso2->initializeLazyPersonnage("lala", -7, null); $perso3->initializeLazyPersonnage("kuku", 101, null); var_dump($perso2, $perso3);</code></pre>

</body>
</html>
