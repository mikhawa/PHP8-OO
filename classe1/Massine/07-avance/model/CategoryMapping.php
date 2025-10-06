<?php
// création du namespace
namespace model;

use Exception;

class CategoryMapping extends AbstractMapping{

    protected ?int $id=null; 
    protected ?string $category_name=null; 
    protected ?string $category_slug=null; 
    protected ?string $category_desc=null; 

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

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }


    public function setCategoryName(?string $name): void
    {
        if(is_null($name)) return;
        $nameClean = trim(htmlspecialchars(strip_tags($name)));
        if(empty($nameClean))
            throw new Exception("Le titre ne peut être vide !");
        if(strlen($nameClean)<2)
            throw new Exception("Le titre est trop court !");
        if(strlen($nameClean)>120)
            throw new Exception("Le titre est trop long !");

        $this->category_name = $nameClean;
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
        if(strlen($category_slug)<2)
            throw new Exception("Le slug est trop court !");
        if(strlen($category_slug)>125)
            throw new Exception("Le slug est trop long !");

        $this->category_slug = $category_slug;
    }

    public function getCategoryDesc(): ?string
    {
        return $this->category_desc;
    }

    public function setCategoryDesc(?string $category_desc): void
    {
        if(is_null($category_desc)) return;
        $category_desc = trim(htmlspecialchars(strip_tags($category_desc)));
        if(empty($category_desc))
            throw new Exception("Le texte ne peut être vide !");
        if(strlen($category_desc)<10)
            throw new Exception("Le texte est trop court !");

        $this->category_desc = $category_desc;
    }


}