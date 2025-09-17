<?php
class LaVoiture{
    // propriétés
    private  $marque=null;
    private  $annee_sortie=null;
    private  $chevaux = null;
    private  $model = null;

    // constantes
    const  VOITURE_NEUVE = true; // par défaut publique
    private const  MOTORISATION = "Essence";
    // Méthodes

    /* Le constructeur est une méthode publique
    magique qui est appelée lors de l'instanciation
    de la classe dans laquelle il se trouve (new)
    */
    public function __construct(string $laMarque,int $year, int $chevaux, string $model){
        $this->marque = $laMarque;
        $this->annee_sortie = $year;
        $this->cheveaux = $chevaux;
        $this->model = $model;
    }

}