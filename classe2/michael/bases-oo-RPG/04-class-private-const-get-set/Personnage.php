<?php

// doit avoir le même nom que le fichier
// une classe par fichier
class Personnage{

    // Propriétés (équivalentes de variables)
    // on va mettre la visibilité (obligatoire) à private
    // (pas d'accès en dehors de la classe ni enfants)
    // bonne pratique, snake_case

    private  ?string $le_nom = null; // visibilité obligatoire,
    // typage conseillé null ou string,
    // valeur par default: null

    private ?int $l_age = null; // attend un entier ou null

    private ?bool $est_vivant = null; // attend un booléen ou null

    // Constantes (équivalentes de constantes)
    // elles sont publiques par défaut
    const string LA_RACE = "Humain";
    private const string LE_GENRE = "Masculin";

    // Méthodes (équivalentes aux fonctions)

        // setters


    /**
     * @param string $nom
     * @return void
     * @throws Exception
     */
    public function setLeNom(string $nom): void
    {
        $thename = trim($nom);

        // On vérifie la longueur du nom
        if (strlen($thename) < 5 || strlen($thename) > 25) {
            throw new Exception("Le nom doit contenir entre 5 et 25 caractères.");
        }

        // On vérifie si le nom correspond à l'expression régulière
        if (!preg_match('/^[a-zA-Z][a-zA-Z0-9]*$/', $thename)) {
            throw new Exception("Le nom doit commencer par une lettre, ne pas contenir d'espaces et ne peut contenir que des lettres et des chiffres.");
        }

        // Si tout est bon, on assigne le nom
        $this->le_nom = $thename;
    }

}