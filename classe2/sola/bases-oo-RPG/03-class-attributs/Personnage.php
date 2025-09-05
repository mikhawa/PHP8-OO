<?php
// Le nom de la classe doit correspondre au nom du fichier
// on déclare une classe avec le mot clef `class{}`

class Personnage
{
    // Attributs
    private string $genre; // attribut public sans valeurs
    private int $age = 25; // avec valeur par défaut
    protected null|string|int $mois; // 3 types possibles

    // Constantes
    // Méthodes
        // création d'une méthode qui change les 3 attributs
    public function initializePersonnage():void
    {
        // on utilise le mot clef $this, celui-ci
        // représente l'instance de type personnage
        $this->genre="Masculin";
        $this->mois="Septembre";
        $this->age = 30;
    }
    public function initializeLazyPersonnage(string $leGenre, int $lAge, null|string|int $leMois):void
    {
        // on utilise le mot clef $this, celui-ci
        // représente l'instance de type personnage
        $this->genre=$leGenre;
        $this->mois=$leMois;
        $this->age = $lAge;
    }

    public function initializeTruePersonnage(string $leGenre, int $lAge, null|string|int $leMois):void
    {
        // Vérifications effectuées par des setters (prochain dossier)
        if(in_array($leGenre, ["Masculin","Féminin"])){
            $this->genre=$leGenre;
        }
        if($lAge >0 && $lAge < 100) {
            $this->age = $lAge;
        }
        if(is_null($leMois)||is_string($leMois)||is_int($leMois)) {
            $this->mois = $leMois;
        }
    }


}