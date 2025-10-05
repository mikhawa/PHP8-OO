<?php
// création du namespace
namespace model;

use Exception;

class ArticleMapping extends AbstractMapping{
    // propriétés = champs de la table
    protected ?int $id=null; // entier positif
    protected ?string $article_title=null; // string de 120 max et 6 minimum sans tags, sans espace devant et derrière, caractères spéciaux encodés
    protected ?string $article_slug=null; // string de 125 max et 6 minimum sans tags, sans espace devant et derrière, caractères spéciaux encodés
    protected ?string $article_text=null; // minimum 20 caractères, sans tags, sans espace devant et derrière, caractères spéciaux encodés
    protected ?string $article_date=null; // doit être une date valide si remplie sinon erreur
    protected null|bool|int $article_visibility=null; // si int convertir en bool, si bool, attribuer la valeur
    protected ?array $category=[]; // contiendra les catégories de l'article actuel

    // méthodes



    // constructeur et hydratation dans AbstractMapping


    // getters et setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id):void
    {
        if(is_null($id)) return;
        if($id<=0)
            throw new Exception("L'id doit être positif");
        $this->id = $id;
    }

    public function getArticleTitle(): ?string
    {
        return $this->article_title;
    }

    // string de 120 max et 6 minimum sans tags, sans espace devant et derrière, caractères spéciaux encodés
    public function setArticleTitle(?string $title): void
    {
        if(is_null($title)) return;
        $titleClean = trim(htmlspecialchars(strip_tags($title)));
        if(empty($titleClean))
            throw new Exception("Le titre ne peut être vide !");
        if(strlen($titleClean)<6)
            throw new Exception("Le titre est trop court !");
        if(strlen($titleClean)>120)
            throw new Exception("Le titre est trop long !");

        $this->article_title = $titleClean;
    }

    public function getArticleSlug(): ?string
    {
        return $this->article_slug;
    }


    // string de 125 max et 6 minimum sans tags, sans espace devant et derrière, caractères spéciaux encodés
    public function setArticleSlug(?string $article_slug): void
    {
        if(is_null($article_slug)) return;
        $article_slug = trim(htmlspecialchars(strip_tags($article_slug)));
        if(empty($article_slug))
            throw new Exception("Le slug ne peut être vide !");
        if(strlen($article_slug)<6)
            throw new Exception("Le slug est trop court !");
        if(strlen($article_slug)>125)
            throw new Exception("Le slug est trop long !");

        $this->article_slug = $article_slug;
    }

    public function getArticleText(): ?string
    {
        return $this->article_text;
    }

    // minimum 20 caractères, sans tags, sans espace devant et derrière, caractères spéciaux encodés
    public function setArticleText(?string $article_text): void
    {
        if(is_null($article_text)) return;
        $article_text = trim(htmlspecialchars(strip_tags($article_text)));
        if(empty($article_text))
            throw new Exception("Le texte ne peut être vide !");
        if(strlen($article_text)<20)
            throw new Exception("Le texte est trop court !");

        $this->article_text = $article_text;
    }

    public function getArticleDate(): ?string
    {
        return $this->article_date;
    }

    // doit être une date valide si remplie sinon erreur
    public function setArticleDate(?string $article_date): void
    {
        if(is_null($article_date)) return;

        $formatDate = strtotime($article_date);
        if($formatDate=== false)
            throw new Exception("La date n'est pas valide !");

        $this->article_date = date("Y-m-d H:i:s",$formatDate);
    }

    public function getArticleVisibility(): bool|int|null
    {
        return $this->article_visibility;
    }

    // si int convertir en bool, si bool, attribuer la valeur
    public function setArticleVisibility(bool|int|null $article_visibility): void
    {
        if(is_null($article_visibility)) return;
            // cause erreur MariaDB
            $article_visibility = (int) $article_visibility;

            $this->article_visibility = $article_visibility;
    }


}
