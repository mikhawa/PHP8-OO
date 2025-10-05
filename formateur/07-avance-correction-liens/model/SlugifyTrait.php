<?php
// création du namespace
namespace model;

use Exception;
trait SlugifyTrait{

    public function slugify(string $text, $prefix=true, string $separator = '-'): string
    {
        // 1. Remplacer les caractères non-alphanumériques par le séparateur
        // \p{L} correspond à n'importe quelle lettre dans n'importe quelle langue
        // \p{N} correspond à n'importe quel chiffre
        // Le 'u' à la fin est pour le support de l'UTF-8
        $text = preg_replace('~[^\pL\d]+~u', $separator, $text);

        // 2. Translittérer les caractères accentués en ASCII
        // Par exemple : 'é' devient 'e'
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // 3. Supprimer les caractères qui ne sont ni des tirets, ni alphanumériques
        $text = preg_replace('~[^-\w]+~', '', $text);

        // 4. Supprimer les séparateurs en début et fin de chaîne
        $text = trim($text, $separator);

        // 5. Supprimer les séparateurs en double
        $text = preg_replace('~-+~', $separator, $text);

        // 6. Mettre toute la chaîne en minuscules
        $text = strtolower($text);

        // si pas de texte valide
        if (empty($text)) {
            throw new Exception("Slugify failed");
        }

        // 7. Si $prefix est à true,
        // on va rajouter un préfixe aléatoire avec des
        // caractères hexadécimaux pour éviter
        // les doublons
        if($prefix===true) {
            $text = bin2hex(random_bytes(2)) . "-" . $text;
        }

        // 8. On retourne la chaîne
        return $text;
    }
    /**
     * Coupe un texte à une longueur maximale sans couper les mots
     * et ajoute des points de suspension si le texte est coupé.
     *
     * @param string $text Le texte à couper.
     * @param int $maxLength La longueur maximale du texte (par défaut 200).
     * @return string Le texte coupé avec des points de suspension si nécessaire.
     */
    public static function cutTheText(string $text, int $maxLength=200): string
    {
        // si le texte est plus court que la longueur max
        if(strlen($text)<=$maxLength){
            return $text;
        }
        // on coupe au max
        $cutText = substr($text,0,$maxLength);
        // on cherche le dernier espace pour ne pas couper un mot
        $lastSpace = strrpos($cutText,' ');
        // s'il y a un espace
        if($lastSpace!==false){
            // on coupe au dernier espace
            $cutText = substr($cutText,0,$lastSpace);
        }
        // on ajoute des points de suspension
        $cutText .= '...';
        return $cutText;
    }
}