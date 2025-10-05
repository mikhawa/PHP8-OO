<?php

namespace model;

use Exception;

class CategoryMapping extends AbstractMapping
{
    protected ?int $id = null;
    protected ?string $category_name = null;
    protected ?string $category_desc = null;
    protected ?string $category_slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        if(is_null($id)) return;
        if($id<=0)
            throw new Exception("L'id doit être positif");
        $this->id = $id;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(?string $category_name): void
    {
        if(is_null($category_name)) return;
        $titleClean = trim(htmlspecialchars(strip_tags($category_name)));
        if(empty($titleClean))
            throw new Exception("Le titre ne peut être vide !");
        if(strlen($titleClean)>80)
            throw new Exception("Le titre est trop long !");

        $this->category_name = $titleClean;
    }

    public function getCategoryDesc(): ?string
    {
        return $this->category_desc;
    }

    public function setCategoryDesc(?string $category_desc): void
    {
        // si vide lors d'un envoi de formulaire (vide)
        if(empty($category_desc))
            $category_desc = null; // on accepte une description vide
        if(is_null($category_desc)) return;
        // nettoyage
        $category_desc = trim(htmlspecialchars(strip_tags($category_desc)));
        // si vide après nettoyage
        if(empty($category_desc))
            $category_desc = null; // on accepte une description vide

        if(strlen($category_desc)>300)
            throw new Exception("Le texte est trop long !");

        $this->category_desc = $category_desc;
    }

    public function getCategorySlug(): ?string
    {
        return $this->category_slug;
    }

    public function setCategorySlug(?string $category_slug): void
    {
        if(is_null($category_slug)) return;
        $category_slug = trim(htmlspecialchars(strip_tags($category_slug)));
        if(empty($category_slug))
            throw new Exception("Le slug ne peut être vide !");
        if(strlen($category_slug)>84)
            throw new Exception("Le slug est trop long !");

        $this->category_slug = $category_slug;
    }



}