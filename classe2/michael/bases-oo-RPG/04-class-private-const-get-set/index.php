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
    <title>Classe avec getters et setters</title>
</head>
<body>
<h1>Classe avec getters et setters</h1>
<h2>Affichage de la classe</h2>
<?php
$perso1 = new Personnage();
?>
<h3>Constante publique</h3>
<p>Les constantes sont par défaut public (mais on peut les rendre private ou protected) elles sont en MAJUSCULE et en SNAKE_CASE, elles doivent être initialisées avec une valeur par défaut.</p>
<p>On peut les afficher avec l'opérateur de résolution de portée <b>::</b></p>
<pre><code>// Mauvaise pratique, on part de l'instance
echo $perso1::LA_RACE." | ";
// Bonne pratique, on part de la class
echo Personnage::LA_RACE;

// bonne pratique, mais ne fonctionne pas car privée
//echo Personnage::LE_GENRE;    </code></pre>
<?php
// Mauvaise pratique, on part de l'instance
echo $perso1::LA_RACE." | ";
// Bonne pratique, on part de la classe
echo Personnage::LA_RACE;
// bonne pratique, mais ne fonctionne pas car privée
//echo Personnage::LE_GENRE;
?>
<?php
var_dump($perso1);
?>

<h2>private</h2>
<p>On ne peut les lire ou les modifier depuis l'extérieur de la classe (ni depuis les enfants voir protected et héritage).</p>
<p>Valable pour les 3 grands types :
<ul>
    <li>propriété</li>
    <li>constante</li>
    <li>méthode</li>
</ul></p>
<pre><code>// Impossible:
$perso1->le_nom = "coucou";
echo $perso1->l_age;
    </code></pre>
<h2>Setters</h2>
<h3>ou mutator, méthodes publiques</h3>
<p>Ils permettent de modifier les propriétés private ou protected (ou public en readonly)</p>
<?php
$perso1->setLeNom(" 25 Z27477");

var_dump($perso1);
?>
</body>
</html>
