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
    <title>Les attributs dans une classe</title>
</head>
<body>
<h1>Les attributs dans une classe</h1>
<h2>Ce sont les "variables" internes de la classe</h2>
<p>Par défaut les attributs sont publiques, c'est-à-dire qu'on peut les lire et les réécrire en dehors de la classe</p>
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

<h2>La visibilité publique des attributs</h2>
<p>On a le type et la valeur <b>*uninitialized*</b> pour les attributs non initialisés, et le type ainsi que la valeur s'ils sont initialisés.</p>

<h3>Modification d'un attribut public</h3>
<h4>Ces attributs sont modifiables depuis l'extérieur de la classe</h4>
<p>Avec le signe instance->attribut = ...</p>
<p>Il faut respecter le typage</p>
<pre><code>$perso1->genre = "Masculin";
$perso1->age=7;
$perso1->mois = null;

$perso2->genre = "Féminin";
$perso2->age=20;
$perso2->mois = "Janvier";

$perso3->genre = "Non genré";
$perso3->age=35;
$perso3->mois = 8;</code></pre>
<?php
$perso1->genre = "Masculin";
$perso1->age=7;
$perso1->mois = null;

$perso2->genre = "Féminin";
$perso2->age=20;
$perso2->mois = "Janvier";

$perso3->genre = "Non genré";
$perso3->age=35;
$perso3->mois = 8;

var_dump($perso1,$perso2,$perso3);
?>
<h3>Affichage d'un attribut public</h3>
<h4>Ces attributs sont affichables depuis l'extérieur de la classe</h4>
<p>Avec le signe echo instance->attribut</p>
<pre><code>echo '$perso1 : '." Genre : {$perso1->genre} | Age : {$perso1->age} | Mois : {$perso1->mois}&lt;br&gt;";
echo '$perso2 : '." Genre : {$perso2->genre} | Age : {$perso2->age} | Mois : {$perso2->mois}&lt;br&gt;";
echo '$perso3 : '." Genre : {$perso3->genre} | Age : {$perso3->age} | Mois : {$perso3->mois}&lt;br&gt;";</code></pre>
<?php
echo '$perso1 : '." Genre : {$perso1->genre} | Age : {$perso1->age} | Mois : {$perso1->mois}
";
echo '$perso2 : '." Genre : {$perso2->genre} | Age : {$perso2->age} | Mois : {$perso2->mois}
";
echo '$perso3 : '." Genre : {$perso3->genre} | Age : {$perso3->age} | Mois : {$perso3->mois}
";
?>
</body>
</html>