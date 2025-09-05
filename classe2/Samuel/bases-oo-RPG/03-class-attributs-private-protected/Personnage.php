<?php

// Le nom de la classe doit être le même que celui du fichier
// on, déclare une classe avec le mot clf "class{}".

class Personnage
{
    // Attributs
    private string $genre; // attribut public sans valeur
    private int $age = 25; // attribut public avec valeur
    protected null|int|string $mois;
    // Constantes
    // Méthodes
        // Création d'une méthode qui change les 3 attributs
        public function initializePersonnage() {
            // On utilise le mot clé $this, celui-ci représente l'instance de type personnage
            $this->genre = "Masculin";
            $this->mois = "Septembre";
            $this->age = 30;
        }

        public function initializeLazyPersonnage(string $leGenre, int $lAge, null|int|string $leMois) : void {
            // On utilise le mot clé $this, celui-ci représente l'instance de type personnage
            $this->genre = $leGenre;
            $this->mois = $lAge;
            $this->age = $leMois;
        }
}