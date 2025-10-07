<?php

namespace model;

use PDO;
use Exception;

class CategoryManager implements CrudInterface, ManagerInterface
{
    private PDO $db;

    public function __construct(PDO $connect)
    {
        $this->db = $connect;
    }

    // Appel du Trait pour slugifier le titre
    use TextTrait;
    public function readAll(bool $orderDesc = true): array
    {
        $sql = "SELECT * FROM category ";
        if($orderDesc) {
            $sql .= "ORDER BY category_name DESC";
        }
        try {
            $query = $this->db->query($sql);
            // pour Agim ;-)
            $result = [];
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $result[] = new CategoryMapping($data);
            }
            return $result;
        }catch (Exception $e){
            die($e->getMessage());
        }



    }

    public function readById(int $id): bool|AbstractMapping
    {
        $sql = "SELECT * FROM category WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            // si pas de catégorie récupérée
            if ($query->rowCount() !== 1) {
                return false;
            }
            // on a une catégorie
            $result = $query->fetch(PDO::FETCH_ASSOC);
            // création de l'instance de type CategoryMapping
            $category = new CategoryMapping($result);
            $query->closeCursor();
            return $category;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function readBySlug(string $slug): bool|AbstractMapping
    {
        $sql = "SELECT * FROM category WHERE category_slug = ?";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([$slug]);
            // si pas de catégorie récupérée
            if ($query->rowCount() !== 1) {
                return false;
            }
            // on a une catégorie
            $result = $query->fetch(PDO::FETCH_ASSOC);
            // création de l'instance de type CategoryMapping
            $category = new CategoryMapping($result);
            $query->closeCursor();
            return $category;
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function create(AbstractMapping $data)
    {
        $sql = "INSERT INTO category (category_name, category_desc, category_slug) 
                VALUES (:category_name, :category_desc, :category_slug)";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(":category_name", $data->getCategoryName());
            // on accepte une description nulle ou de type string
            $query->bindValue(":category_desc", $data->getCategoryDesc(), PDO::PARAM_STR|PDO::PARAM_NULL);
            $query->bindValue(":category_slug", $data->getCategorySlug());
            $query->execute();
    }catch (Exception $e){
            return $e->getMessage();
        }
        return true;
    }

    public function update(int $id, AbstractMapping $data)
    {
        $sql = "UPDATE category 
                SET category_name = :category_name, 
                    category_desc = :category_desc, 
                    category_slug = :category_slug
                WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(":category_name", $data->getCategoryName());
            // on accepte une description nulle ou de type string
            $query->bindValue(":category_desc", $data->getCategoryDesc(), PDO::PARAM_STR|PDO::PARAM_NULL);
            $query->bindValue(":category_slug", $data->getCategorySlug());
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
        return true;
    }

    public function delete(int $id): true|string
    {
        // avant de supprimer une catégorie,
        // il faut supprimer les liens dans article_category (si pas de contrainte avec cascade)
        $sql = "DELETE FROM article_has_category WHERE category_id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
        // puis on supprime la catégorie
        $sql = "DELETE FROM category WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
        }catch (Exception $e){
            return $e->getMessage();
        }
        return true;
    }




}