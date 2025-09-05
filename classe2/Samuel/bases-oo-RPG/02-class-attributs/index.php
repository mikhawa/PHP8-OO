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
    <title>Les attributs dans une classe</title>
</head>
<body>

<h1>Les attributs dans une classe</h1>
<h2>Ce sont les "variables" interne de la classe</h2>
<p>Par défaut les attributs sont publique, c'est a dire qu'on peut les lire et les récrire en dehors de la classe.</p>


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

<h2>La visibilité public des attributs :</h2>
<p>On a le type et la valeur <b>*uninitialized*</b> pour les attributs non initialisé et le type et la valeur s'ils sont initialisés.   </p>

<h3>Modification d'un attributs public :</h3>
<p>Avec le signe fleche instance->attributs = valeurs</p>
<p>Il faut respecter le type </p>
<pre>
<?php
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
?>
</pre>
<h3>Affichage :</h3>
<h4>Ces attributs sont modifiables depuis l'extérieur de la classe</h4>
<p>avec le signe echo instance-> attribut</p>
<pre>
<?php
echo '$perso1 : '. "Genre :{$perso1->genre} | Age :{$perso1->age} ans, Mois :{$perso1->mois}" ."<br>";
echo '$perso2 : '. "Genre :{$perso2->genre} | Age :{$perso2->age} ans, Mois :{$perso2->mois}" ."<br>";
echo '$perso3 : '. "Genre :{$perso3->genre} | Age :{$perso3->age} ans, Mois :{$perso3->mois}" ."<br>";
?>
</pre>


</body>
</html>
